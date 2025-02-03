<!DOCTYPE html>
<html>
<head>
    <title>Login Notification</title>
</head>
<body>
    <h1>Hello, {{ $name }}</h1>
    <p>You have successfully logged in to your account.</p>
    <p>Login Time: {{ $loginTime }}</p>
    <p>Device: {{ $deviceType }}</p>
    <p>IP Address: {{ $userIp }}</p>
    <p>If this wasn't you, please contact our support team immediately.</p>
</body>
</html>

