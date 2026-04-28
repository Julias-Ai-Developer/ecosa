<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable(['name', 'email', 'password', 'is_admin', 'must_change_password'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected function casts(): array
    {
        return [
            'email_verified_at'   => 'datetime',
            'is_admin'            => 'boolean',
            'must_change_password' => 'boolean',
            'password'            => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function membershipProfile(): HasOne
    {
        return $this->hasOne(MembershipProfile::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function chaptersCreated(): HasMany
    {
        return $this->hasMany(Chapter::class, 'created_by');
    }

    public function hasRole(string $slug): bool
    {
        return $this->is_admin || $this->roles->contains('slug', $slug);
    }

    public function hasPermission(string $slug): bool
    {
        if ($this->is_admin) {
            return true;
        }

        return $this->roles->flatMap->permissions->contains('slug', $slug);
    }

    public function canAccessAdmin(): bool
    {
        return $this->is_admin || $this->roles->isNotEmpty();
    }

    public function allowedAdminSlugs(): array
    {
        if ($this->is_admin) {
            return ['admin.dashboard', 'admin.news', 'admin.community', 'admin.team',
                    'admin.chapters', 'admin.resources', 'admin.members', 'admin.messages',
                    'admin.notifications', 'admin.roles', 'admin.users', 'admin.payments.view',
                    'admin.payments.confirm', 'admin.payments.verify'];
        }

        return $this->roles->flatMap->permissions->pluck('slug')->unique()->values()->all();
    }
}
