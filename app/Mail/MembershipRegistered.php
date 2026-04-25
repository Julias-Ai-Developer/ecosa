<?php

namespace App\Mail;

use App\Models\MembershipProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly MembershipProfile $membershipProfile,
        public readonly ?string $plainPassword = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to ECOSA — Your Membership Details & Portal Access',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.membership-registered',
        );
    }
}
