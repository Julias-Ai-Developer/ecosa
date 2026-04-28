<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'created_by',
    'approved_by',
    'name',
    'slug',
    'category',
    'profession',
    'business_sector',
    'region',
    'whatsapp_link',
    'description',
    'reason',
    'status',
    'admin_notes',
    'approved_at',
])]
class Chapter extends Model
{
    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Chapter $chapter): void {
            if (! $chapter->slug) {
                $chapter->slug = Str::slug($chapter->name).'-'.Str::lower(Str::random(5));
            }
        });
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(ChapterMembership::class);
    }

    public function approvedMemberships(): HasMany
    {
        return $this->memberships()->where('status', 'approved');
    }

    public function categoryLabel(): string
    {
        return match ($this->category) {
            'professional' => 'Professional',
            'business' => 'Business',
            'class_year' => 'Class Year',
            default => 'Regional',
        };
    }
}
