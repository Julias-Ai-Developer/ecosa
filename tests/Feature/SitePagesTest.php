<?php

use App\Livewire\Admin\CommunityManager;
use App\Livewire\Admin\MembersIndex;
use App\Livewire\Admin\MessagesIndex;
use App\Livewire\Admin\NewsManager;
use App\Livewire\Admin\TeamManager;
use App\Livewire\Dashboard;
use App\Livewire\Site\Contact;
use App\Livewire\Site\FooterContactForm;
use App\Livewire\Site\Membership;
use App\Mail\MembershipRegistered;
use App\Models\ContactInquiry;
use App\Models\CommunityProgram;
use App\Models\LeadershipMember;
use App\Models\MembershipProfile;
use App\Models\NewsUpdate;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

test('public site pages render', function (string $uri, string $text) {
    $this->get($uri)
        ->assertSuccessful()
        ->assertSee($text, false);
})->with([
    ['/', 'Alumni & Student Empowerment Programs'],
    ['/about-us', 'About ECOSA'],
    ['/leadership', 'Leadership'],
    ['/governance', 'Governance'],
    ['/membership', 'Membership'],
    ['/membership/register', 'Membership Registration'],
    ['/community', 'Community'],
    ['/community/events', 'Community Events'],
    ['/community/projects', 'Projects'],
    ['/community/insurance-group', 'Insurance Group'],
    ['/latest-updates', 'Latest Updates'],
    ['/contact-us', 'Contact ECOSA'],
]);

test('membership registration form can be submitted and linked to a user account', function () {
    Mail::fake();

    Livewire::test(Membership::class)
        ->set('fullName', 'Jane Alumni')
        ->set('email', 'jane@example.com')
        ->set('completionYear', '2015')
        ->set('phone', '+256700000000')
        ->set('currentAddress', 'Kampala, Uganda')
        ->set('occupationType', 'professional')
        ->set('occupationTitle', 'Architect')
        ->set('maritalStatus', 'single')
        ->call('openPaymentModal')
        ->assertSet('showPaymentModal', true)
        ->set('paymentMethod', 'mtn_mobile_money')
        ->set('paymentPhone', '+256700000000')
        ->call('completeRegistration')
        ->assertSet('submitted', true)
        ->assertSet('submittedMembershipNumber', 'EC-0001')
        ->assertSet('fullName', '');

    $this->assertDatabaseHas('membership_profiles', [
        'full_name' => 'Jane Alumni',
        'email' => 'jane@example.com',
        'completion_year' => 2015,
        'membership_number' => 'EC-0001',
        'payment_status' => 'pending_verification',
        'payment_method' => 'mtn_mobile_money',
        'payment_phone' => '+256700000000',
        'occupation_type' => 'professional',
        'occupation_title' => 'Architect',
        'current_address' => 'Kampala, Uganda',
        'marital_status' => 'single',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'jane@example.com',
        'name' => 'Jane Alumni',
    ]);

    Mail::assertSent(MembershipRegistered::class);
});

test('membership registration form can be prefilled from quick registration query data', function () {
    Livewire::withQueryParams([
        'full_name' => 'Drawer Visitor',
        'email' => 'drawer@example.com',
        'phone' => '+256700000777',
        'completion_year' => '2014',
        'occupation_type' => 'employment',
    ])->test(Membership::class)
        ->assertSet('fullName', 'Drawer Visitor')
        ->assertSet('email', 'drawer@example.com')
        ->assertSet('phone', '+256700000777')
        ->assertSet('completionYear', '2014')
        ->assertSet('occupationType', 'employment');
});

test('membership registration can capture business details and mastercard reference', function () {
    Mail::fake();

    Livewire::test(Membership::class)
        ->set('fullName', 'Paid Alumni')
        ->set('email', 'paid@example.com')
        ->set('completionYear', '2012')
        ->set('phone', '+256711111111')
        ->set('currentAddress', 'Mbarara, Uganda')
        ->set('occupationType', 'business')
        ->set('occupationTitle', 'Business Owner')
        ->set('businessName', 'Paid Alumni Ventures')
        ->set('businessNature', 'Retail and logistics')
        ->set('maritalStatus', 'married')
        ->call('openPaymentModal')
        ->set('paymentMethod', 'mastercard')
        ->set('paymentReference', 'CARD-12345')
        ->call('completeRegistration')
        ->assertSet('submittedPaymentStatus', 'Pending Verification');

    $this->assertDatabaseHas('membership_profiles', [
        'email' => 'paid@example.com',
        'membership_number' => 'EC-0001',
        'payment_status' => 'pending_verification',
        'payment_method' => 'mastercard',
        'payment_reference' => 'CARD-12345',
        'occupation_type' => 'business',
        'business_name' => 'Paid Alumni Ventures',
        'business_nature' => 'Retail and logistics',
        'marital_status' => 'married',
        'amount_paid' => MembershipProfile::REGISTRATION_FEE,
    ]);
});

test('contact form can be submitted', function () {
    Livewire::test(Contact::class)
        ->set('name', 'Jane Alumni')
        ->set('email', 'jane@example.com')
        ->set('phone', '+256700000000')
        ->set('inquiryType', 'Projects & Partnerships')
        ->set('message', 'I would like to learn more about membership and partnership opportunities.')
        ->call('sendMessage')
        ->assertSet('submitted', true)
        ->assertSet('name', '');

    $this->assertDatabaseHas('contact_inquiries', [
        'name' => 'Jane Alumni',
        'email' => 'jane@example.com',
        'phone' => '+256700000000',
        'inquiry_type' => 'Projects & Partnerships',
    ]);
});

test('footer contact form can be submitted', function () {
    Livewire::test(FooterContactForm::class)
        ->set('name', 'Footer Visitor')
        ->set('email', 'footer@example.com')
        ->set('message', 'Please guide me on membership registration and alumni support options.')
        ->call('sendMessage')
        ->assertSet('submitted', true)
        ->assertSet('name', '');

    $this->assertDatabaseHas('contact_inquiries', [
        'name' => 'Footer Visitor',
        'email' => 'footer@example.com',
        'inquiry_type' => 'Footer Message',
        'status' => 'new',
    ]);
});

test('logged in user can see membership details on the member portal', function () {
    $user = User::factory()->create(['email' => 'member@example.com']);

    MembershipProfile::query()->create([
        'membership_number' => 'EC-0100',
        'full_name' => 'Member Example',
        'email' => 'member@example.com',
        'phone' => '+256700000000',
        'current_address' => 'Kampala, Uganda',
        'completion_year' => 2016,
        'occupation_type' => 'employment',
        'occupation_title' => 'Operations Manager',
        'marital_status' => 'single',
        'membership_status' => 'pending',
        'payment_status' => 'pending_verification',
        'registration_fee' => MembershipProfile::REGISTRATION_FEE,
        'amount_paid' => MembershipProfile::REGISTRATION_FEE,
        'payment_method' => 'mtn_mobile_money',
        'payment_phone' => '+256700000000',
        'payment_reference' => 'MM-0100',
        'paid_at' => now(),
    ]);

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertSuccessful()
        ->assertSee('Member Portal')
        ->assertSee('EC-0100')
        ->assertSee('Pending Verification');

    expect(MembershipProfile::query()->where('email', 'member@example.com')->value('user_id'))->toBe($user->id);
});

test('dashboard can record payment reference for the logged in member', function () {
    $user = User::factory()->create(['email' => 'unpaid@example.com']);

    MembershipProfile::query()->create([
        'user_id' => $user->id,
        'membership_number' => 'EC-0200',
        'full_name' => 'Unpaid Example',
        'email' => 'unpaid@example.com',
        'phone' => '+256700000000',
        'current_address' => 'Ibanda, Uganda',
        'completion_year' => 2018,
        'occupation_type' => 'employment',
        'occupation_title' => 'Teacher',
        'marital_status' => 'single',
        'membership_status' => 'pending',
        'payment_status' => 'unpaid',
        'registration_fee' => MembershipProfile::REGISTRATION_FEE,
    ]);

    $this->actingAs($user);

    Livewire::test(Dashboard::class)
        ->set('paymentMethod', 'airtel_money')
        ->set('paymentReference', 'AIRTEL-9876')
        ->call('recordPayment')
        ->assertSet('paymentRecorded', true);

    $this->assertDatabaseHas('membership_profiles', [
        'membership_number' => 'EC-0200',
        'payment_status' => 'pending_verification',
        'payment_method' => 'airtel_money',
        'payment_reference' => 'AIRTEL-9876',
        'amount_paid' => MembershipProfile::REGISTRATION_FEE,
    ]);
});

test('non admin users can not access admin routes', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('admin can search filter and verify registered members', function () {
    $user = User::factory()->admin()->create();

    $paid = MembershipProfile::query()->create([
        'membership_number' => 'EC-0300',
        'full_name' => 'Paid Alumni',
        'email' => 'paid.member@example.com',
        'phone' => '+256700000001',
        'current_address' => 'Ntinda, Kampala',
        'completion_year' => 2011,
        'occupation_type' => 'business',
        'occupation_title' => 'Founder',
        'business_name' => 'Paid Ventures',
        'business_nature' => 'Consulting',
        'marital_status' => 'married',
        'membership_status' => 'active',
        'payment_status' => 'paid',
        'registration_fee' => MembershipProfile::REGISTRATION_FEE,
        'amount_paid' => MembershipProfile::REGISTRATION_FEE,
        'payment_method' => 'mastercard',
        'payment_reference' => 'CARD-0300',
        'paid_at' => now(),
    ]);

    $pending = MembershipProfile::query()->create([
        'membership_number' => 'EC-0301',
        'full_name' => 'Pending Alumni',
        'email' => 'pending.member@example.com',
        'phone' => '+256700000002',
        'current_address' => 'Kololo, Kampala',
        'completion_year' => 2014,
        'occupation_type' => 'employment',
        'occupation_title' => 'Administrator',
        'marital_status' => 'single',
        'membership_status' => 'pending',
        'payment_status' => 'pending_verification',
        'registration_fee' => MembershipProfile::REGISTRATION_FEE,
        'amount_paid' => MembershipProfile::REGISTRATION_FEE,
        'payment_method' => 'mtn_mobile_money',
        'payment_reference' => 'MM-0301',
        'paid_at' => now(),
    ]);

    MembershipProfile::query()->create([
        'membership_number' => 'EC-0302',
        'full_name' => 'Unpaid Alumni',
        'email' => 'unpaid.member@example.com',
        'phone' => '+256700000003',
        'current_address' => 'Gulu, Uganda',
        'completion_year' => 2017,
        'occupation_type' => 'professional',
        'occupation_title' => 'Engineer',
        'marital_status' => 'single',
        'membership_status' => 'pending',
        'payment_status' => 'unpaid',
        'registration_fee' => MembershipProfile::REGISTRATION_FEE,
    ]);

    $this->actingAs($user);

    Livewire::test(MembersIndex::class)
        ->assertSee('Search, verify, and review member registrations')
        ->assertSee('EC-0300')
        ->assertSee('EC-0301')
        ->set('search', 'Paid Ventures')
        ->assertSee('Paid Alumni')
        ->assertDontSee('Pending Alumni')
        ->set('search', '')
        ->set('paymentStatus', 'pending_verification')
        ->assertSee('Pending Alumni')
        ->assertDontSee('Paid Alumni')
        ->call('verifyPayment', $pending->id);

    $this->assertDatabaseHas('membership_profiles', [
        'id' => $pending->id,
        'membership_status' => 'active',
        'payment_status' => 'paid',
    ]);

    expect($paid->fresh()->payment_status)->toBe('paid');
});

test('admin can upload news team and community content', function () {
    Storage::fake('uploads');
    $tinyPng = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=');
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin);

    Livewire::test(NewsManager::class)
        ->set('newsCategory', 'Project')
        ->set('newsTitle', 'Library Project Update')
        ->set('newsSummary', 'ECOSA has received new library project materials.')
        ->set('newsBody', 'Full update body.')
        ->set('newsImage', UploadedFile::fake()->createWithContent('library.png', $tinyPng))
        ->call('saveNews')
        ->assertSet('newsSaved', true);

    Livewire::test(TeamManager::class)
        ->set('leaderName', 'Jane Leader')
        ->set('leaderInitials', 'JL')
        ->set('leaderTitle', 'Chairperson')
        ->set('leaderPortfolio', 'Strategic Leadership')
        ->set('leaderFocus', 'Leads ECOSA programs and member engagement.')
        ->set('leaderPhoto', UploadedFile::fake()->createWithContent('leader.png', $tinyPng))
        ->call('saveLeader')
        ->assertSet('leaderSaved', true);

    Livewire::test(CommunityManager::class)
        ->set('programType', 'project')
        ->set('programTitle', 'Mentorship Expansion')
        ->set('programSummary', 'A stronger mentorship pipeline for students and young alumni.')
        ->set('programBody', 'Extended project information.')
        ->set('programLocation', 'Hybrid')
        ->set('programStatus', 'active')
        ->set('programImage', UploadedFile::fake()->createWithContent('program.png', $tinyPng))
        ->call('saveProgram')
        ->assertSet('programSaved', true);

    expect(NewsUpdate::query()->where('title', 'Library Project Update')->exists())->toBeTrue();
    expect(LeadershipMember::query()->where('name', 'Jane Leader')->exists())->toBeTrue();
    expect(CommunityProgram::query()->where('title', 'Mentorship Expansion')->exists())->toBeTrue();
});

test('admin can review and mark website messages as read', function () {
    $admin = User::factory()->admin()->create();
    $message = ContactInquiry::query()->create([
        'name' => 'Website Visitor',
        'email' => 'visitor@example.com',
        'phone' => '+256700001234',
        'inquiry_type' => 'Insurance Group',
        'message' => 'Please share more information about the group insurance structure.',
        'status' => 'new',
    ]);

    $this->actingAs($admin);

    Livewire::test(MessagesIndex::class)
        ->assertSee('Review inquiries from the public website')
        ->assertSee('Website Visitor')
        ->call('markRead', $message->id);

    $this->assertDatabaseHas('contact_inquiries', [
        'id' => $message->id,
        'status' => 'read',
    ]);
});
