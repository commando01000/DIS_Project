<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #4CAF50;
            text-align: center;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 20px;
            color: #555;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
        }

        .section p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }

        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>New Contact Request</h1>

        <div class="section">
            <h2>Contact Details:</h2>
            <p><strong>Subject:</strong> {{ $email->subject }}</p>
        </div>

        <div class="section">
            <h2>Message:</h2>
            <p>{{ $email->body }}</p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </div>
    </div>
</body>

</html>
