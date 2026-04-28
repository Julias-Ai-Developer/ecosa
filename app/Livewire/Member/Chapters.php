<?php

namespace App\Livewire\Member;

use App\Models\Chapter;
use App\Models\ChapterMembership;
use App\Models\MembershipProfile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('My Chapter')]
class Chapters extends Component
{
    public string $selectedChapter = '';

    public string $name = '';

    public string $category = 'regional';

    public string $region = '';

    public string $profession = '';

    public string $businessSector = '';

    public string $description = '';

    public string $reason = '';

    public bool $saved = false;

    public function joinChapter(): void
    {
        $profile = $this->membershipProfile();

        if (! $profile) {
            $this->addError('selectedChapter', 'You need a membership profile before joining a chapter.');

            return;
        }

        if ($profile->chapterMembership()->exists()) {
            $this->addError('selectedChapter', 'You already belong to a chapter. Contact admin to change it.');

            return;
        }

        $this->validate([
            'selectedChapter' => ['required', 'integer', Rule::exists('chapters', 'id')->where('status', 'approved')],
        ]);

        ChapterMembership::create([
            'chapter_id' => (int) $this->selectedChapter,
            'membership_profile_id' => $profile->id,
            'status' => 'approved',
            'joined_at' => now(),
        ]);

        $this->saved = true;
        $this->selectedChapter = '';
    }

    public function requestChapter(): void
    {
        $profile = $this->membershipProfile();

        if (! $profile) {
            $this->addError('name', 'You need a membership profile before requesting a chapter.');

            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:160'],
            'category' => ['required', Rule::in(['regional', 'professional', 'business', 'class_year'])],
            'region' => ['nullable', 'string', 'max:120'],
            'profession' => ['nullable', 'string', 'max:120'],
            'businessSector' => ['nullable', 'string', 'max:120'],
            'description' => ['required', 'string', 'min:20', 'max:1000'],
            'reason' => ['required', 'string', 'min:20', 'max:1000'],
        ]);

        Chapter::create([
            'created_by' => Auth::id(),
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']).'-'.Str::lower(Str::random(5)),
            'category' => $validated['category'],
            'region' => $validated['region'] ?: null,
            'profession' => $validated['profession'] ?: null,
            'business_sector' => $validated['businessSector'] ?: null,
            'description' => $validated['description'],
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        $this->reset('name', 'region', 'profession', 'businessSector', 'description', 'reason');
        $this->category = 'regional';
        $this->saved = true;
    }

    public function render(): View
    {
        $profile = $this->membershipProfile();

        return view('livewire.member.chapters', [
            'profile' => $profile,
            'currentMembership' => $profile?->chapterMembership()->with('chapter')->first(),
            'chapters' => Chapter::approved()->withCount('approvedMemberships')->orderBy('name')->get(),
            'myRequests' => Chapter::query()->where('created_by', Auth::id())->latest()->get(),
        ]);
    }

    private function membershipProfile(): ?MembershipProfile
    {
        $user = Auth::user();

        return MembershipProfile::query()
            ->where(fn ($query) => $query->where('user_id', $user->id)->orWhere('email', $user->email))
            ->first();
    }
}
