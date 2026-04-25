<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'category',
    'title',
    'summary',
    'body',
    'image_path',
    'is_published',
    'published_at',
])]
class NewsUpdate extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function imageUrl(): string
    {
        if ($this->image_path) {
            return asset('assets/uploads/'.$this->image_path);
        }

        return asset('assets/images/school/aerialview.jpeg');
    }
}
