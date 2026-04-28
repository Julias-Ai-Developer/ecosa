<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'initials',
    'title',
    'portfolio',
    'focus',
    'icon',
    'tone',
    'photo_path',
    'sort_order',
    'group',
    'is_published',
])]
class LeadershipMember extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function photoUrl(): ?string
    {
        return $this->photo_path ? asset('assets/uploads/'.$this->photo_path) : null;
    }
}
