<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        p {
            line-height: 1.6;
        }
        strong {
            color: #555;
        }
    </style>
</head>
<body>
    <h1>New Contact Form Submission</h1>
    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>City:</strong> {{ $city }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone }}</p>
    <p><strong>Message:</strong> {{ $message }}</p> <!-- Ensure this is a string -->
</body>
</html>
