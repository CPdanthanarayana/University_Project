<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Allocation Request Rejected</title>
</head>
<body>
    <h2>Vehicle Allocation Request Rejected</h2>

    <p>Dear {{ $application->applicant->name }},</p>

    <p>Your vehicle allocation request has been <strong>rejected</strong> by the Dean.</p>

    <p><strong>Application Details:</strong></p>
    <ul>
        <li>From: {{ $application->from_location }}</li>
        <li>To: {{ $application->to_location }}</li>
        <li>Departure Date: {{ $application->departure_date }}</li>
        <li>Return Date: {{ $application->return_date }}</li>
    </ul>

    <p>Thank you,<br>{{ config('app.name') }}</p>
</body>
</html>
