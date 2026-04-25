<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MemberNotification extends Model
{
    protected $fillable = ['title', 'body', 'target_type', 'member_profile_id', 'sent_by'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(MembershipProfile::class, 'member_profile_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    public function readers(): BelongsToMany
    {
        return $this->belongsToMany(
            MembershipProfile::class,
            'member_notification_reads',
            'notification_id',
            'member_profile_id'
        )->withPivot('read_at');
    }

    public function isReadBy(int $memberProfileId): bool
    {
        return $this->readers()->where('member_profile_id', $memberProfileId)->exists();
    }

    public function scopeForMember($query, int $memberProfileId)
    {
        return $query->where(function ($q) use ($memberProfileId) {
            $q->where('target_type', 'all')
              ->orWhere(function ($q2) use ($memberProfileId) {
                  $q2->where('target_type', 'specific')
                     ->where('member_profile_id', $memberProfileId);
              });
        });
    }
}
