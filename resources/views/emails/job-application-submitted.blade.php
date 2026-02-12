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
        <tr><td><strong>Province</strong></td><td>{{ $application->province }}</td></tr>
        <tr><td><strong>City</strong></td><td>{{ $application->city }}</td></tr>
        <tr><td><strong>Speaks English</strong></td><td>{{ $application->speaks_english ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>English Level</strong></td><td>{{ $application->english_level ?: '-' }}</td></tr>
        <tr><td><strong>Willing to Travel</strong></td><td>{{ $application->willing_to_travel ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Has Motorbike</strong></td><td>{{ $application->has_motorbike ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Has Passport</strong></td><td>{{ $application->has_passport ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Can Drive Car</strong></td><td>{{ $application->can_drive_car ? 'Yes' : 'No' }}</td></tr>
        <tr><td><strong>Position</strong></td><td>{{ $application->position_title }}</td></tr>
        <tr><td><strong>Submitted At</strong></td><td>{{ $application->created_at->format('Y-m-d H:i') }}</td></tr>
    </table>

    <p style="margin-top: 16px; color: #4b5563;">Resume is attached to this email.</p>
</body>
</html>
