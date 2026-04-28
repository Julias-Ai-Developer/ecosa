<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'uploaded_by',
    'title',
    'category',
    'summary',
    'file_path',
    'external_url',
    'media_type',
    'is_published',
    'sort_order',
])]
class ResourceDocument extends Model
{
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

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function fileUrl(): ?string
    {
        return $this->file_path ? asset('assets/uploads/'.$this->file_path) : null;
    }

    public function linkUrl(): ?string
    {
        return $this->external_url ?: $this->fileUrl();
    }
}
