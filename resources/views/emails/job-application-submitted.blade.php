<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Job Application</title>
</head>
<body style="margin:0; padding:0; background:#f3f5f4; font-family:Arial, Helvetica, sans-serif; color:#1b1b18;">
    @php
        $timezone = '+08:00';
        $submittedAt = $application->created_at?->copy()->timezone($timezone);
        $referenceUrl = $application->reference_token ? route('references.show', $application->reference_token) : '-';
    @endphp
    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#f3f5f4; padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width:760px; background:#ffffff; border:1px solid #d8e4de; border-radius:14px; overflow:hidden;">
                    <tr>
                        <td style="background:#ffffff; border-top:6px solid #1f5f46; border-bottom:1px solid #e8efeb; padding:24px 24px 20px; text-align:center;">
                            <img src="{{ asset('images/logo.png') }}" alt="{{ (config('app.name') ?: 'StaffLink') . ' logo' }}" width="140" style="display:block; margin:0 auto 14px; max-width:140px; width:100%; height:auto;" loading="lazy">
                            <p style="margin:0; font-size:12px; letter-spacing:1.6px; text-transform:uppercase; color:#8b6d1a;">Career Application</p>
                            <h1 style="margin:10px 0 0; font-size:24px; line-height:1.3; color:#1f5f46;">New Candidate Submitted</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <p style="margin:0 0 16px; font-size:14px; color:#3f4b45;">
                                A new job application has been submitted through the website form.
                            </p>

                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse; border:1px solid #d8e4de; border-radius:10px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background:#f4efe0; color:#5e4a1f; font-weight:700; font-size:13px; padding:10px 14px; text-transform:uppercase; letter-spacing:0.8px;">
                                        Candidate Details
                                    </td>
                                </tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Name</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->full_name }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Email</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->email }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Phone</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->phone }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Age</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->age }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Religion</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->religion }}</td></tr>
                                <tr>
                                    <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Address</td>
                                    <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->address ?: trim($application->city . ', ' . $application->province, ', ') }}</td>
                                </tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Position</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->position_title }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Submitted At (UTC+8)</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $submittedAt?->format('Y-m-d H:i') ?? '-' }}</td></tr>
                            </table>

                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top:14px; border-collapse:collapse; border:1px solid #d8e4de; border-radius:10px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background:#f4efe0; color:#5e4a1f; font-weight:700; font-size:13px; padding:10px 14px; text-transform:uppercase; letter-spacing:0.8px;">
                                        Qualifications and Mobility
                                    </td>
                                </tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Speaks English</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->speaks_english ? 'Yes' : 'No' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">English Level</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->english_level ?: '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Willing to Travel</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->willing_to_travel ? 'Yes' : 'No' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Has Motorbike</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->has_motorbike ? 'Yes' : 'No' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Has Passport</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->has_passport ? 'Yes' : 'No' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Can Drive Car</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->can_drive_car ? 'Yes' : 'No' }}</td></tr>
                            </table>

                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top:14px; border-collapse:collapse; border:1px solid #d8e4de; border-radius:10px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background:#f4efe0; color:#5e4a1f; font-weight:700; font-size:13px; padding:10px 14px; text-transform:uppercase; letter-spacing:0.8px;">
                                        Attachments and References
                                    </td>
                                </tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Attachment Link</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->attachment_link ?: '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Reference Name</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->reference_name ?: '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Reference Company</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->reference_company ?: '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Reference Phone</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->reference_phone ?: '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Reference Email</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->reference_email ?: '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Reference Link</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $referenceUrl }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Resume File</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->resume_path ? 'Attached' : '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">ID/KTP File</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->id_ktp_path ? 'Attached' : '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">SKCK File</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->skck_path ? 'Attached' : '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Cover Letter File</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->cover_letter_file_path ? 'Attached' : '-' }}</td></tr>
                                <tr><td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">Portfolio File</td><td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ $application->portfolio_file_path ? 'Attached' : '-' }}</td></tr>
                            </table>

                            @if (is_array($application->custom_answers) && count($application->custom_answers) > 0)
                                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-top:14px; border-collapse:collapse; border:1px solid #d8e4de; border-radius:10px; overflow:hidden;">
                                    <tr>
                                        <td colspan="2" style="background:#f4efe0; color:#5e4a1f; font-weight:700; font-size:13px; padding:10px 14px; text-transform:uppercase; letter-spacing:0.8px;">
                                            Custom Question Answers
                                        </td>
                                    </tr>
                                    @foreach ($application->custom_answers as $question => $answer)
                                        <tr>
                                            <td style="width:38%; padding:10px 14px; font-size:13px; color:#4b5b53; border-top:1px solid #e8efeb;">{{ $question }}</td>
                                            <td style="padding:10px 14px; font-size:14px; color:#173f31; border-top:1px solid #e8efeb;">{{ is_array($answer) ? implode(', ', $answer) : $answer }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif

                            <p style="margin:14px 0 0; font-size:12px; color:#607067;">
                                Attached files may include resume, ID/KTP, SKCK, and optional supporting documents.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#1f5f46; border-top:4px solid #b28b2e; padding:14px 20px; text-align:center;">
                            <p style="margin:0; font-size:12px; color:#e9d29d;">{{ config('app.name') }} • Internal Career Notification</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
