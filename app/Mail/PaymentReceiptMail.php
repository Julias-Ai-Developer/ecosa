<?php

namespace App\Mail;

use App\Models\MembershipProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public MembershipProfile $profile)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('ECOSA Payment Receipt')
            ->view('mail.payment-receipt');
    }
}
