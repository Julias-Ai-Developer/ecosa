<div style="font-family: Arial, sans-serif; color: #102b47; line-height: 1.6;">
    <h1 style="margin-bottom: 8px;">ECOSA Payment Receipt</h1>
    <p>Dear {{ $profile->full_name }},</p>
    <p>Your payment has been verified by ECOSA. Below are the receipt details.</p>

    <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">Receipt For</td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;"><strong>{{ $profile->paymentPurposeLabel() }}</strong></td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">Member</td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $profile->full_name }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">Membership Number</td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $profile->membership_number }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">Amount</td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">UGX {{ number_format($profile->amount_paid) }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">Payment Method</td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $profile->paymentMethodLabel() }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">Reference</td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $profile->payment_reference ?: 'Not recorded' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">Verified At</td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ optional($profile->payment_verified_at)->format('M j, Y g:i A') }}</td>
        </tr>
    </table>

    <p>Thank you for supporting ECOSA.</p>
</div>
