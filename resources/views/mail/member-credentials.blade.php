<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your ECOSA Portal Credentials</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f4f7fb; margin: 0; padding: 32px 16px; color: #1e293b; }
        .card { background: #fff; border-radius: 16px; max-width: 560px; margin: 0 auto; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #173a60, #17924b); padding: 36px 40px; text-align: center; }
        .header img { height: 60px; border-radius: 12px; background: #fff; padding: 8px; }
        .header h1 { color: #fff; font-size: 22px; font-weight: 700; margin: 16px 0 4px; }
        .header p { color: rgba(255,255,255,0.7); font-size: 13px; margin: 0; }
        .body { padding: 36px 40px; }
        .body p { font-size: 15px; line-height: 1.7; color: #475569; margin: 0 0 16px; }
        .creds { background: #f0f7ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 24px; margin: 24px 0; }
        .cred-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .cred-row:last-child { margin-bottom: 0; }
        .cred-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b; }
        .cred-value { font-family: monospace; font-size: 16px; font-weight: 700; color: #173a60; background: #fff; padding: 6px 12px; border-radius: 8px; border: 1px solid #e2e8f0; }
        .btn { display: block; background: #17924b; color: #fff; text-decoration: none; font-weight: 700; font-size: 15px; text-align: center; padding: 14px 32px; border-radius: 10px; margin: 28px 0 0; }
        .footer { padding: 20px 40px; border-top: 1px solid #f1f5f9; text-align: center; font-size: 12px; color: #94a3b8; }
        .warning { background: #fffbeb; border: 1px solid #fde68a; border-radius: 10px; padding: 14px 18px; font-size: 13px; color: #92400e; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="{{ asset('assets/images/logo.png') }}" alt="ECOSA Logo">
            <h1>Welcome to ECOSA</h1>
            <p>Equatorial College Old Students Association</p>
        </div>
        <div class="body">
            <p>Dear <strong>{{ $fullName }}</strong>,</p>
            <p>Your membership has been verified and your portal account is now active. Use the credentials below to log in to your member portal.</p>

            <div class="creds">
                <div class="cred-row">
                    <span class="cred-label">Membership ID</span>
                    <span class="cred-value">{{ $membershipNumber }}</span>
                </div>
                <div class="cred-row">
                    <span class="cred-label">Email</span>
                    <span class="cred-value">{{ $email }}</span>
                </div>
                <div class="cred-row">
                    <span class="cred-label">Password</span>
                    <span class="cred-value">{{ $plainPassword }}</span>
                </div>
            </div>

            <p>You can log in using your <strong>Membership ID</strong>, email address, or phone number — together with the password above.</p>

            <a href="{{ url('/login') }}" class="btn">Log in to your portal &rarr;</a>

            <div class="warning">
                <strong>Keep this email safe.</strong> For security, please change your password after your first login. Do not share these credentials with anyone.
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Equatorial College Old Students Association. All rights reserved.
        </div>
    </div>
</body>
</html>
