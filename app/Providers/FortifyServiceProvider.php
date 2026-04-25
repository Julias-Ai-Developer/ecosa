<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Models\MembershipProfile;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->configureActions();
        $this->configureViews();
        $this->configureRateLimiting();
    }

    private function configureActions(): void
    {
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::createUsersUsing(CreateNewUser::class);

        // Login via email, phone, or membership number.
        // Super-admins (is_admin=true) may only login with email or phone — not membership number.
        Fortify::authenticateUsing(function (Request $request) {
            $identifier = trim($request->input('email', ''));
            $password   = $request->input('password', '');

            // 1. Try direct email match (all users)
            $user = User::where('email', $identifier)->first();

            // 2. Try phone via MembershipProfile (all users)
            if (! $user) {
                $profile = MembershipProfile::query()
                    ->where('phone', $identifier)
                    ->first();

                if ($profile && $profile->user_id) {
                    $user = User::find($profile->user_id);
                }
            }

            // 3. Try membership number (members only — super-admins blocked)
            if (! $user) {
                $profile = MembershipProfile::query()
                    ->where('membership_number', $identifier)
                    ->first();

                if ($profile && $profile->user_id) {
                    $candidate = User::find($profile->user_id);
                    // Block membership-number login for super-admins
                    if ($candidate && ! $candidate->is_admin) {
                        $user = $candidate;
                    }
                }
            }

            if ($user && Hash::check($password, $user->password)) {
                return $user;
            }

            return null;
        });
    }

    private function configureViews(): void
    {
        Fortify::loginView(fn () => view('livewire.auth.login'));
        Fortify::verifyEmailView(fn () => view('livewire.auth.verify-email'));
        Fortify::twoFactorChallengeView(fn () => view('livewire.auth.two-factor-challenge'));
        Fortify::confirmPasswordView(fn () => view('livewire.auth.confirm-password'));
        Fortify::registerView(fn () => view('livewire.auth.register'));
        Fortify::resetPasswordView(fn () => view('livewire.auth.reset-password'));
        Fortify::requestPasswordResetLinkView(fn () => view('livewire.auth.forgot-password'));
    }

    private function configureRateLimiting(): void
    {
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input('email', '')).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
