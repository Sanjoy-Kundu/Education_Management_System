<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created</title>
</head>
<body>
    <h1>Welcome to {{$data['name']}}</h1>
    <p>Your account has been created successfully. Below are your account details:</p>
    <ul>
        <li>Name: {{ $data['name'] }}</li>
        <li>Email: {{ $data['email'] }}</li>
        <li>Role: {{$data['role'] }}</li>
        <li>Random Password: {{ $randomPassword }}</li>
    </ul>
    <p>Please use the above credentials to log in to your account.</p>
</body>
</html>
