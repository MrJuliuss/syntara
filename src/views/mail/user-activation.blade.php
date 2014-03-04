<!DOCTYPE html>
<html>
<head>
    <title>Account activation</title>
</head>
<body>
    <h1>Activate your account</h1>
    <p>Hello, {{ $username }}</p>

    <p>We confirm your account creation, but it must be activated before being used.</p>
    <p>Click the link below to activate your account.</p>

    <p><a href="{{ URL::route('getActivate', $code) }}">Activate your account</a></p>

    <p>Admin</p>
</body>
</html>