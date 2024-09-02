<!DOCTYPE html>
<html>
<head>

</head>
<body style="text-align: center;">
<div style="max-width: 600px; margin: 0 auto; text-align: left;">
    <p>
        Hi <b>{{ $name }}</b>,
    </p>

    <p>
        We've received a request to reset your password.
    </p>

    <p>
        If you didn't make the request, just ignore this message. Otherwise, you can reset your password.
    </p>
    
    <p>
        <strong>The OTP to reset your password is:</strong>  
    </p>
    
    <h2 style="background: #00466a; width: max-content; padding: 0 10px; color: #fff; border-radius: 4px; margin: 0 auto;"> {{ $otp }}</h2>
</div>

</body>
</html>
