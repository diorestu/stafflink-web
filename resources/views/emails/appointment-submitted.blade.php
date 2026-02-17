<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Appointment Booking</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111827; line-height: 1.6;">
    <h2 style="margin-bottom: 8px;">New Appointment Booking Received</h2>
    <p style="margin-top: 0; color: #4b5563;">A new consultation appointment has been submitted from the website.</p>

    <table cellpadding="6" cellspacing="0" border="0" style="border-collapse: collapse;">
        <tr><td><strong>Name</strong></td><td>{{ $appointment->name }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $appointment->email }}</td></tr>
        <tr><td><strong>Phone</strong></td><td>{{ $appointment->phone }}</td></tr>
        <tr><td><strong>Company</strong></td><td>{{ $appointment->company ?: '-' }}</td></tr>
        <tr><td><strong>Start Time</strong></td><td>{{ optional($appointment->starts_at)->format('Y-m-d H:i') }}</td></tr>
        <tr><td><strong>End Time</strong></td><td>{{ optional($appointment->ends_at)->format('Y-m-d H:i') }}</td></tr>
        <tr><td><strong>Status</strong></td><td>{{ ucfirst($appointment->status) }}</td></tr>
        <tr><td><strong>Notes</strong></td><td>{{ $appointment->notes ?: '-' }}</td></tr>
        <tr><td><strong>Submitted At</strong></td><td>{{ optional($appointment->created_at)->format('Y-m-d H:i') }}</td></tr>
    </table>
</body>
</html>
