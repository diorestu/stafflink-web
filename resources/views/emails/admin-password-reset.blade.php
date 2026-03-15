<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Your Admin Password</title>
</head>
<body style="margin:0; padding:0; background:#f3f5f4; font-family:Arial, Helvetica, sans-serif; color:#1b1b18;">
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f3f5f4; padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:680px; background:#ffffff; border:1px solid #d8e4de; border-radius:14px; overflow:hidden;">
                    <tr>
                        <td style="background:#ffffff; border-top:6px solid #1f5f46; border-bottom:1px solid #e8efeb; padding:24px 24px 20px; text-align:center;">
                            <img src="{{ asset('images/logo.png') }}" alt="{{ (config('app.name') ?: 'StaffLink') . ' logo' }}" width="140" style="display:block; margin:0 auto 14px; max-width:140px; width:100%; height:auto;" loading="lazy">
                            <p style="margin:0; font-size:12px; letter-spacing:1.6px; text-transform:uppercase; color:#8b6d1a;">Admin Security</p>
                            <h1 style="margin:10px 0 0; font-size:24px; line-height:1.3; color:#1f5f46;">Reset Your Password</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <p style="margin:0 0 14px; font-size:14px; color:#3f4b45;">
                                We received a request to reset your StaffLink admin password for <strong>{{ $email }}</strong>.
                            </p>
                            <p style="margin:0 0 20px; font-size:14px; color:#3f4b45;">
                                Click the button below to set a new password. This link expires in {{ $expireMinutes }} minutes.
                            </p>

                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:0 auto 18px;">
                                <tr>
                                    <td align="center" style="border-radius:10px; background:#1f5f46;">
                                        <a href="{{ $resetUrl }}" style="display:inline-block; padding:12px 22px; font-size:14px; font-weight:700; color:#ffffff; text-decoration:none; border-radius:10px;">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:0 0 8px; font-size:12px; color:#68756e;">If the button does not work, copy this URL into your browser:</p>
                            <p style="margin:0; font-size:12px; color:#1f5f46; word-break:break-all;">
                                <a href="{{ $resetUrl }}" style="color:#1f5f46; text-decoration:underline;">{{ $resetUrl }}</a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#1f5f46; border-top:4px solid #b28b2e; padding:14px 20px; text-align:center;">
                            <p style="margin:0; font-size:12px; color:#e9d29d;">{{ config('app.name') }} • Admin Password Security</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
