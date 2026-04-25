<p>Dear {{ $membershipProfile->full_name }},</p>

<p>
    Thank you for registering with the Equatorial College School Old Students Association (ECOSA).
    Your membership submission has been received successfully.
</p>

<p>
    <strong>Membership ID:</strong> {{ $membershipProfile->membership_number }}<br>
    <strong>Payment status:</strong> {{ $membershipProfile->paymentStatusLabel() }}<br>
    <strong>Payment method:</strong> {{ $membershipProfile->paymentMethodLabel() }}
</p>

<p>
    You can access the member portal using this email address:
    <a href="{{ route('login') }}">{{ route('login') }}</a>.
    If you have not set a password yet, use the password reset page:
    <a href="{{ route('password.request') }}">{{ route('password.request') }}</a>.
</p>

<p>Thank you,<br>ECOSA Membership Team</p>
