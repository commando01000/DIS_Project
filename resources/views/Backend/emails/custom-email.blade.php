<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        h1 {
            font-size: 22px;
            color: #4CAF50;
            text-align: center;
            margin-bottom: 20px;
        }

        .email-body {
            margin-bottom: 20px;
            line-height: 1.6;
            color: #555;
        }

        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .sent-date {
            margin-top: 20px;
            font-size: 14px;
            text-align: right;
            color: #888;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Email Notification</h1>

        <div class="email-body">
            {!! $email->body !!}
        </div>

        <div class="sent-date">
            Sent on: {{ $email->date ? $email->date->format('Y-m-d H:i:s') : 'N/A' }}
        </div>

        <div style="text-align: center;">
            <a href="#" class="btn text-light">Visit Our Website</a>
        </div>
    </div>

    <div class="email-footer">
        &copy; {{ date('Y') }} DIS. All rights reserved.
    </div>
</body>

</html>
