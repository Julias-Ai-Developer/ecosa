<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to ECOSA</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
               background: #f4f7fb; padding: 32px 16px; color: #1e293b; }
        .wrap  { max-width: 580px; margin: 0 auto; }

        /* Header */
        .header { background: linear-gradient(135deg, #0e6433 0%, #173a60 100%);
                  border-radius: 18px 18px 0 0; padding: 36px 40px; text-align: center; }
        .header img   { height: 64px; border-radius: 14px; background: #fff; padding: 8px; margin-bottom: 16px; }
        .header h1    { color: #fff; font-size: 22px; font-weight: 800; margin: 0 0 4px; letter-spacing: -0.3px; }
        .header p     { color: rgba(255,255,255,0.65); font-size: 12.5px; letter-spacing: 0.05em; margin: 0; }

        /* Body */
        .body         { background: #fff; padding: 36px 40px; }
        .body p       { font-size: 14.5px; line-height: 1.75; color: #475569; margin-bottom: 16px; }
        .body p:last-child { margin-bottom: 0; }
        .name         { font-weight: 700; color: #0e6433; }

        /* Status banner */
        .status-banner { background: #fefce8; border: 1px solid #fde68a; border-radius: 12px;
                         padding: 14px 18px; margin: 20px 0; font-size: 13.5px; color: #92400e;
                         display: flex; align-items: flex-start; gap: 10px; }
        .status-icon   { font-size: 18px; flex-shrink: 0; margin-top: 1px; }

        /* Credentials box */
        .creds         { background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 14px;
                         padding: 24px 28px; margin: 24px 0; }
        .creds-title   { font-size: 10.5px; font-weight: 800; text-transform: uppercase;
                         letter-spacing: 0.18em; color: #15803d; margin-bottom: 16px; }
        .cred-row      { display: flex; justify-content: space-between; align-items: center;
                         padding: 10px 0; border-bottom: 1px solid #bbf7d0; }
        .cred-row:last-child { border-bottom: none; padding-bottom: 0; }
        .cred-label    { font-size: 11.5px; font-weight: 700; text-transform: uppercase;
                         letter-spacing: 0.1em; color: #64748b; }
        .cred-value    { font-family: 'Courier New', monospace; font-size: 15px; font-weight: 700;
                         color: #0e6433; background: #fff; padding: 5px 12px;
                         border-radius: 8px; border: 1px solid #d1fae5; }

        /* Details table */
        .section-title { font-size: 10.5px; font-weight: 800; text-transform: uppercase;
                         letter-spacing: 0.18em; color: #94a3b8; margin: 28px 0 14px; }
        .detail-table  { width: 100%; border-collapse: collapse; }
        .detail-table td { padding: 9px 0; border-bottom: 1px solid #f1f5f9;
                           font-size: 13.5px; vertical-align: top; }
        .detail-table tr:last-child td { border-bottom: none; }
        .detail-label  { color: #64748b; font-weight: 600; width: 42%; }
        .detail-value  { color: #1e293b; font-weight: 500; }

        /* CTA */
        .btn-wrap      { text-align: center; margin: 28px 0; }
        .btn           { display: inline-block; background: #0e6433; color: #fff;
                         text-decoration: none; font-weight: 700; font-size: 15px;
                         padding: 14px 36px; border-radius: 10px; letter-spacing: 0.02em; }

        /* Warning */
        .warning       { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px;
                         padding: 16px 20px; font-size: 13px; color: #1e40af; line-height: 1.6;
                         margin-top: 24px; }
        .warning strong { color: #1d4ed8; }

        /* Footer */
        .footer        { background: #f8fafc; border-radius: 0 0 18px 18px; border-top: 1px solid #e2e8f0;
                         padding: 22px 40px; text-align: center;
                         font-size: 11.5px; color: #94a3b8; line-height: 1.7; }
        .footer a      { color: #0e6433; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">
    <div class="header">
        <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA">
        <h1>Equatorial College Old Students Association</h1>
        <p>ECOSA — Together for the Bright Future</p>
    </div>

    <div class="body">
        <p>Dear <span class="name">{{ $membershipProfile->full_name }}</span>,</p>
        <p>
            Thank you for registering with ECOSA! Your membership application has been received
            and is now pending payment verification by our team.
        </p>

        <div class="status-banner">
            <span class="status-icon">⏳</span>
            <div>
                <strong>Payment Pending Verification</strong><br>
                Once our team confirms your payment of <strong>UGX 20,000</strong>,
                your membership will be fully activated. This usually takes 1–2 business days.
            </div>
        </div>

        @if ($plainPassword)
        {{-- New account — show credentials --}}
        <p>
            Your member portal account has been created. Use the credentials below to log in now.
            You will be asked to set a new password on your first login.
        </p>

        <div class="creds">
            <p class="creds-title">Your Portal Login Credentials</p>
            <div class="cred-row">
                <span class="cred-label">Member ID</span>
                <span class="cred-value">{{ $membershipProfile->membership_number }}</span>
            </div>
            <div class="cred-row">
                <span class="cred-label">Email</span>
                <span class="cred-value">{{ $membershipProfile->email }}</span>
            </div>
            <div class="cred-row">
                <span class="cred-label">Temp Password</span>
                <span class="cred-value">{{ $plainPassword }}</span>
            </div>
        </div>

        <p>
            You can log in using your <strong>Member ID</strong>, email address,
            or phone number — together with the password above.
        </p>

        <div class="btn-wrap">
            <a href="{{ url('/login') }}" class="btn">Log in to Member Portal &rarr;</a>
        </div>

        <div class="warning">
            <strong>Security notice:</strong> This is a temporary password. You will be prompted
            to set a permanent password when you first log in. Keep this email safe and
            do not share your credentials with anyone.
        </div>

        @else
        {{-- Existing account — just remind them they already have access --}}
        <p>
            You already have a portal account. Log in using your existing credentials at any time.
        </p>
        <div class="btn-wrap">
            <a href="{{ url('/login') }}" class="btn">Log in to Member Portal &rarr;</a>
        </div>
        @endif

        {{-- Registration details --}}
        <p class="section-title">Your Registration Details</p>
        <table class="detail-table">
            <tr>
                <td class="detail-label">Member ID</td>
                <td class="detail-value">{{ $membershipProfile->membership_number }}</td>
            </tr>
            <tr>
                <td class="detail-label">Full Name</td>
                <td class="detail-value">{{ $membershipProfile->full_name }}</td>
            </tr>
            <tr>
                <td class="detail-label">Email Address</td>
                <td class="detail-value">{{ $membershipProfile->email }}</td>
            </tr>
            <tr>
                <td class="detail-label">Phone Number</td>
                <td class="detail-value">{{ $membershipProfile->phone ?? '—' }}</td>
            </tr>
            <tr>
                <td class="detail-label">Completion Year</td>
                <td class="detail-value">{{ $membershipProfile->completion_year ?? '—' }}</td>
            </tr>
            <tr>
                <td class="detail-label">Current Address</td>
                <td class="detail-value">{{ $membershipProfile->current_address ?? '—' }}</td>
            </tr>
            <tr>
                <td class="detail-label">Profession</td>
                <td class="detail-value">{{ $membershipProfile->occupation_title ?? '—' }}</td>
            </tr>
            <tr>
                <td class="detail-label">Payment Method</td>
                <td class="detail-value">{{ $membershipProfile->paymentMethodLabel() }}</td>
            </tr>
            <tr>
                <td class="detail-label">Amount Paid</td>
                <td class="detail-value">UGX {{ number_format($membershipProfile->amount_paid) }}</td>
            </tr>
            <tr>
                <td class="detail-label">Payment Status</td>
                <td class="detail-value">{{ $membershipProfile->paymentStatusLabel() }}</td>
            </tr>
            <tr>
                <td class="detail-label">Registration Date</td>
                <td class="detail-value">{{ $membershipProfile->created_at?->format('d F Y') }}</td>
            </tr>
        </table>

        <p style="margin-top:24px;">
            If you have any questions, please contact the ECOSA membership team. We look forward to
            welcoming you into our alumni community.
        </p>
        <p>Warm regards,<br><strong>ECOSA Membership Team</strong></p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Equatorial College Old Students Association. All rights reserved.<br>
        <a href="{{ url('/') }}">Visit our website</a> &nbsp;·&nbsp;
        <a href="{{ url('/login') }}">Member Portal</a>
    </div>
</div>
</body>
</html>
