<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'chapter_id',
    'membership_profile_id',
    'status',
    'joined_at',
])]
class ChapterMembership extends Model
{
    protected function casts(): array
    {
        return [
            'joined_at' => 'datetime',
        ];
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function membershipProfile(): BelongsTo
    {
        return $this->belongsTo(MembershipProfile::class);
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            default => 'Pending Approval',
        };
    }
}
