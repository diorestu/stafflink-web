<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Job Application</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111827; line-height: 1.6;">
    <h2 style="margin-bottom: 8px;">New Job Application Received</h2>
    <p style="margin-top: 0; color: #4b5563;">A new candidate has submitted an application.</p>

    <table cellpadding="6" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr><td><strong>Name</strong></td><td>{{ $application->full_name }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $application->email }}</td></tr>
        <tr><td><strong>Phone</strong></td><td>{{ $application->phone }}</td></tr>
        <tr><td><strong>Age</strong></td><td>{{ $application->age }}</td></tr>
        <tr><td><strong>Religion</strong></td><td>{{ $application->religion }}</td></tr>
        <tr>
            <td><strong>Address</strong></td>
            <td>{{ $application->address ?: trim($application->city . ', ' . $application->province, ', ') }}</td>
        </tr>
        <tr><td><strong>Speaks English</strong></td><td>{{ $application->speaks_english ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>English Level</strong></td><td>{{ $application->english_level ?: '-' }}</td></tr>
        <tr><td><strong>Willing to Travel</strong></td><td>{{ $application->willing_to_travel ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Has Motorbike</strong></td><td>{{ $application->has_motorbike ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Has Passport</strong></td><td>{{ $application->has_passport ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Can Drive Car</strong></td><td>{{ $application->can_drive_car ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Position</strong></td><td>{{ $application->position_title }}</td></tr>
        <tr><td><strong>Attachment Link</strong></td><td>{{ $application->attachment_link ?: '-' }}</td></tr>
        <tr><td><strong>Reference Name</strong></td><td>{{ $application->reference_name ?: '-' }}</td></tr>
        <tr><td><strong>Reference Company</strong></td><td>{{ $application->reference_company ?: '-' }}</td></tr>
        <tr><td><strong>Reference Phone</strong></td><td>{{ $application->reference_phone ?: '-' }}</td></tr>
        <tr><td><strong>Reference Email</strong></td><td>{{ $application->reference_email ?: '-' }}</td></tr>
        <tr>
            <td><strong>Reference Link</strong></td>
            <td>
                @if ($application->reference_token)
                    {{ route('references.show', $application->reference_token) }}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr><td><strong>Resume File</strong></td><td>{{ $application->resume_path ? 'Attached' : '-' }}</td></tr>
        <tr><td><strong>ID/KTP File</strong></td><td>{{ $application->id_ktp_path ? 'Attached' : '-' }}</td></tr>
        <tr><td><strong>SKCK File</strong></td><td>{{ $application->skck_path ? 'Attached' : '-' }}</td></tr>
        <tr><td><strong>Cover Letter File</strong></td><td>{{ $application->cover_letter_file_path ? 'Attached' : '-' }}</td></tr>
        <tr><td><strong>Portfolio File</strong></td><td>{{ $application->portfolio_file_path ? 'Attached' : '-' }}</td></tr>
        <tr><td><strong>Submitted At</strong></td><td>{{ $application->created_at->format('Y-m-d H:i') }}</td></tr>
    </table>

    @if (is_array($application->custom_answers) && count($application->custom_answers) > 0)
        <h3 style="margin-top: 16px; margin-bottom: 8px;">Custom Question Answers</h3>
        <table cellpadding="6" cellspacing="0" border="0" style="border-collapse: collapse;">
            @foreach ($application->custom_answers as $question => $answer)
                <tr>
                    <td><strong>{{ $question }}</strong></td>
                    <td>{{ $answer }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <p style="margin-top: 16px; color: #4b5563;">Attached files include resume, ID/KTP, SKCK, and optional files when provided.</p>
</body>
</html>
