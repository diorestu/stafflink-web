<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Appointment Booking</title>
</head>
<body style="margin:0; padding:0; background:#f3f5f4; font-family:Arial, Helvetica, sans-serif; color:#1b1b18;">
    @php
        $timezone = '+08:00';
        $startsAt = $appointment->starts_at?->copy()->timezone($timezone);
        $endsAt = $appointment->ends_at?->copy()->timezone($timezone);
        $submittedAt = $appointment->created_at?->copy()->timezone($timezone);
    @endphp
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f3f5f4; padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:680px; background:#ffffff; border:1px solid #d8e4de; border-radius:14px; overflow:hidden;">
                    <tr>
                        <td style="background:#ffffff; border-top:6px solid #1f5f46; border-bottom:1px solid #e8efeb; padding:24px 24px 20px; text-align:center;">
                            <img src="{{ asset('images/logo.png') }}" alt="{{ (config('app.name') ?: 'StaffLink') . ' logo' }}" width="140" style="display:block; margin:0 auto 14px; max-width:140px; width:100%; height:auto;" loading="lazy">
                            <p style="margin:0; font-size:12px; letter-spacing:1.6px; text-transform:uppercase; color:#8b6d1a;">New Consultation</p>
                            <h1 style="margin:10px 0 0; font-size:24px; line-height:1.3; color:#1f5f46;">Appointment Booking Received</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <p style="margin:0 0 16px; font-size:14px; color:#3f4b45;">
                                A new consultation appointment has been submitted via website form.
                            </p>

                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse; border:1px solid #d8e4de; border-radius:10px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background:#f4efe0; color:#5e4a1f; font-weight:700; font-size:13px; padding:10px 14px; text-transform:uppercase; letter-spacing:0.8px;">
                                        Booking Details (UTC+8)
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Name</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $appointment->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Email</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $appointment->email }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Phone</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $appointment->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Company</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $appointment->company ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Start Time</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $startsAt?->format('Y-m-d H:i') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">End Time</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $endsAt?->format('Y-m-d H:i') ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Status</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ ucfirst($appointment->status) }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Notes</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $appointment->notes ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Submitted At</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $submittedAt?->format('Y-m-d H:i') ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#1f5f46; border-top:4px solid #b28b2e; padding:14px 20px; text-align:center;">
                            <p style="margin:0; font-size:12px; color:#e9d29d;">{{ config('app.name') }} • Internal Booking Notification</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
