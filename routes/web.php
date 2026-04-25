<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use App\Livewire\Admin\CommunityManager;
use App\Livewire\Admin\DashboardIndex;
use App\Livewire\Admin\MessagesIndex;
use App\Livewire\Admin\MembersIndex;
use App\Livewire\Admin\NewsManager;
use App\Livewire\Admin\TeamManager;
use App\Livewire\Dashboard;
use App\Livewire\Site\About;
use App\Livewire\Site\Community;
use App\Livewire\Site\CommunityEvents;
use App\Livewire\Site\CommunityInsurance;
use App\Livewire\Site\CommunityProjects;
use App\Livewire\Site\Contact;
use App\Livewire\Site\Governance;
use App\Livewire\Site\Home;
use App\Livewire\Site\Leadership;
use App\Livewire\Site\Membership;
use App\Livewire\Site\MembershipHub;
use App\Livewire\Site\Updates;
use Illuminate\Support\Facades\Route;

Route::livewire('/', Home::class)->name('home');
Route::redirect('home', '/');
Route::livewire('about-us', About::class)->name('site.about');
Route::livewire('leadership', Leadership::class)->name('site.leadership');
Route::livewire('governance', Governance::class)->name('site.governance');
Route::livewire('membership', MembershipHub::class)->name('site.membership');
Route::livewire('membership/register', Membership::class)->name('site.membership.register');
Route::livewire('community', Community::class)->name('site.community');
Route::livewire('community/events', CommunityEvents::class)->name('site.community.events');
Route::livewire('community/projects', CommunityProjects::class)->name('site.community.projects');
Route::livewire('community/insurance-group', CommunityInsurance::class)->name('site.community.insurance');
Route::livewire('latest-updates', Updates::class)->name('site.updates');
Route::livewire('contact-us', Contact::class)->name('site.contact');

Route::middleware(['auth'])->group(function () {
    Route::livewire('dashboard', Dashboard::class)->name('dashboard');
});

Route::middleware(['auth', 'verified', EnsureUserIsAdmin::class])->group(function () {
    Route::livewire('admin', DashboardIndex::class)->name('admin.dashboard');
    Route::redirect('admin/content', 'admin/news');
    Route::livewire('admin/news', NewsManager::class)->name('admin.news');
    Route::livewire('admin/community', CommunityManager::class)->name('admin.community');
    Route::livewire('admin/team', TeamManager::class)->name('admin.team');
    Route::livewire('admin/members', MembersIndex::class)->name('admin.members');
    Route::livewire('admin/messages', MessagesIndex::class)->name('admin.messages');
});

require __DIR__.'/settings.php';
