<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wedding Nanny Booking Updated</title>
</head>
<body style="margin:0; padding:0; background:#f3f5f4; font-family:Arial, Helvetica, sans-serif; color:#1b1b18;">
    @php
        $timezone = '+08:00';
        $submittedAt = $inquiry->created_at?->copy()->timezone($timezone);
        $weddingDate = $inquiry->wedding_date?->format('Y-m-d') ?: '-';
        $families = $groupedInquiries->count();
    @endphp
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f3f5f4; padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:680px; background:#ffffff; border:1px solid #d8e4de; border-radius:14px; overflow:hidden;">
                    <tr>
                        <td style="background:#ffffff; border-top:6px solid #1f5f46; border-bottom:1px solid #e8efeb; padding:24px;">
                            <p style="margin:0; font-size:12px; letter-spacing:1.6px; text-transform:uppercase; color:#8b6d1a;">Wedding Nanny Booking</p>
                            <h1 style="margin:10px 0 0; font-size:24px; line-height:1.3; color:#1f5f46;">Booking Sheet Updated</h1>
                            <p style="margin:12px 0 0; font-size:14px; line-height:1.5; color:#3f4b45;">
                                A new inquiry has been added to this wedding group. The latest Excel-ready CSV is attached.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse; border:1px solid #d8e4de; border-radius:10px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background:#f4efe0; color:#5e4a1f; font-weight:700; font-size:13px; padding:10px 14px; text-transform:uppercase; letter-spacing:0.8px;">
                                        Wedding Group Summary
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Wedding Of</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $inquiry->wedding_couple_names }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Wedding Date</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $weddingDate }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Start Time</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $inquiry->wedding_start_time }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Families Registered</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $families }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Total Children</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $totalChildren }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Total Nannies Needed</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $totalNannies }}</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Latest Guest</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $inquiry->guardian_name }} ({{ $inquiry->guardian_email }})</td>
                                </tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Submitted At</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $submittedAt?->format('Y-m-d H:i') ?? '-' }} (UTC+8)</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
