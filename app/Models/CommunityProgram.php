<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'type',
    'title',
    'summary',
    'body',
    'location',
    'status',
    'image_path',
    'cta_label',
    'cta_url',
    'starts_at',
    'ends_at',
    'sort_order',
    'is_published',
])]
class CommunityProgram extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeForType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function imageUrl(): string
    {
        if ($this->image_path) {
            return asset('assets/uploads/'.$this->image_path);
        }

        return match ($this->type) {
            'project' => asset('assets/images/school/Equatorial-College-School5.jpeg'),
            default => asset('assets/images/school/aerialview.jpeg'),
        };
    }

    public function typeLabel(): string
    {
        return match ($this->type) {
            'insurance_group' => 'Insurance Group',
            'project' => 'Projects',
            default => 'Events',
        };
    }

    public function scheduleLabel(): ?string
    {
        if (! $this->starts_at) {
            return null;
        }

        if (! $this->ends_at) {
            return $this->starts_at->format('M j, Y');
        }

        if ($this->starts_at->isSameDay($this->ends_at)) {
            return $this->starts_at->format('M j, Y');
        }

        return $this->starts_at->format('M j').' - '.$this->ends_at->format('M j, Y');
    }
}
