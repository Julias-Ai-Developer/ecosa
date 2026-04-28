<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'user_id',
    'membership_number',
    'full_name',
    'email',
    'phone',
    'current_address',
    'completion_year',
    'occupation_type',
    'occupation_title',
    'business_name',
    'business_nature',
    'marital_status',
    'membership_status',
    'payment_status',
    'payment_purpose',
    'registration_fee',
    'amount_paid',
    'payment_method',
    'payment_phone',
    'payment_reference',
    'payment_confirmed_by',
    'payment_confirmed_at',
    'payment_verified_by',
    'payment_verified_at',
    'paid_at',
])]
class MembershipProfile extends Model
{
    use HasFactory;

    public const REGISTRATION_FEE = 20000;

    protected function casts(): array
    {
        return [
            'completion_year' => 'integer',
            'registration_fee' => 'integer',
            'amount_paid' => 'integer',
            'payment_confirmed_at' => 'datetime',
            'payment_verified_at' => 'datetime',
            'paid_at' => 'datetime',
        ];
    }

    public static function nextMembershipNumber(): string
    {
        $nextId = ((int) static::query()->max('id')) + 1;

        return 'EC-'.str_pad((string) $nextId, 4, '0', STR_PAD_LEFT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chapterMembership(): HasOne
    {
        return $this->hasOne(ChapterMembership::class);
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_confirmed_by');
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_verified_by');
    }

    public function membershipStatusLabel(): string
    {
        return match ($this->membership_status) {
            'active' => 'Active Member',
            'suspended' => 'Suspended',
            default => 'Application Pending',
        };
    }

    public function paymentStatusLabel(): string
    {
        return match ($this->payment_status) {
            'paid' => 'Paid',
            'confirmed' => 'Confirmed - Awaiting Verification',
            'pending_verification' => 'Pending Verification',
            default => 'Unpaid',
        };
    }

    public function paymentStatusTone(): string
    {
        return match ($this->payment_status) {
            'paid' => 'bg-[#67bc45] text-white',
            'confirmed' => 'bg-[#173a60] text-white',
            'pending_verification' => 'bg-[#ffd600] text-[#102b47]',
            default => 'bg-[#e91e63] text-white',
        };
    }

    public function paymentMethodLabel(): string
    {
        return match ($this->payment_method) {
            'mtn_mobile_money' => 'MTN MoMo',
            'airtel_money' => 'Airtel Money',
            'mastercard' => 'Mastercard',
            default => 'Not recorded',
        };
    }

    public function paymentPurposeLabel(): string
    {
        return match ($this->payment_purpose) {
            'donation' => 'Donation',
            'chapter_support' => 'Chapter Support',
            'project_support' => 'Project Support',
            'welfare_support' => 'Welfare / Insurance Support',
            default => 'Membership',
        };
    }

    public function occupationTypeLabel(): string
    {
        return match ($this->occupation_type) {
            'professional' => 'Professional Practice',
            'employment' => 'Employment / Job',
            'business' => 'Business / Enterprise',
            default => 'Not recorded',
        };
    }
}
