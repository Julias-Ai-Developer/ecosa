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
        public MembershipProfile $membershipProfile
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ECOSA membership registration received - '.$this->membershipProfile->membership_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.membership-registered',
        );
    }
}
