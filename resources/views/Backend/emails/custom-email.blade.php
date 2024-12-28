<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sent Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 20px;
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

        .recipients {
            margin-top: 10px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .recipients ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .recipients li {
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .recipients li:last-child {
            border-bottom: none;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Email Sent</h1>

        <div class="section">
            <h2>Subject</h2>
            <p>{{ $email->subject }}</p>
        </div>

        <div class="section">
            <h2>Body</h2>
            <div>
                {!! $email->body !!}
            </div>
        </div>

        <div class="section">
            <h2>Recipients</h2>
            <div class="recipients">
                <ul>
                    @foreach ($email->recipients as $recipient)
                        <li>{{ $recipient->email }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="section">
            <h2>Status</h2>
            <p>{{ ucfirst($email->status) }}</p>
        </div>

        <div class="section">
            <h2>Sent Date</h2>
            <p>{{ $email->date ? $email->date->format('Y-m-d H:i:s') : 'N/A' }}</p>
        </div>
    </div>

    <footer>
        &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </footer>
</body>

</html>
