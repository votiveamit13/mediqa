<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Job Application Received</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f7f7f7; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background: #fff; border-radius: 12px; padding: 30px;">
        
        <h2 style="color: #111; margin-bottom: 20px;">New Job Application Received</h2>

        <p>Hello {{ $healthcare->name }},</p>

        <p>
            You have received a new application for the job:
            <strong>{{ $job->job_title ?? 'Job Role' }}</strong>
        </p>

        <p><strong>Candidate Details:</strong></p>
        <ul>
            <li><strong>Name:</strong> {{ $candidate->name }}</li>
            <li><strong>Email:</strong> {{ $candidate->email }}</li>
        </ul>

        <p>
            Please log in to your Mediqa account to review the application.
        </p>

        <br>

        <p>Regards,<br><strong>Mediqa Team</strong></p>
    </div>
</body>
</html>