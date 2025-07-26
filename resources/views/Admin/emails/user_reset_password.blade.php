<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        h3 {
            text-align: center;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h3>Reseting password</h3>
    <p>Dear {{ $user->name }} ,</p>
    <p>Your OTP code for Reseting password is : {{ $user->otp }}</p>
</body>
</html>