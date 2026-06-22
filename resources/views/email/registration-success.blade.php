<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration Successful</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <div style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">

        <h2 style="color: #2563eb;">
            Welcome {{ $registration->username }}
        </h2>

        <p>
            Thank you for registering with <strong>SV Distribution</strong>.
        </p>

        <p>
            Your registration has been successfully completed.
        </p>

        <h3>Registration Details</h3>

        <p>
            <strong>Name:</strong> {{ $registration->username }}
        </p>

        <p>
            <strong>Email:</strong> {{ $registration->email }}
        </p>

        <p>
            <strong>Phone:</strong> {{ $registration->phone }}
        </p>

        <hr>

        <p>
            We appreciate your interest in our products and services.
            Our team will contact you if any further information is required.
        </p>

        <p>
            Regards,<br>
            <strong>SV Distribution</strong><br>
            PV Sami Road, Chalappuram, 673002
        </p>

    </div>

</body>
</html>