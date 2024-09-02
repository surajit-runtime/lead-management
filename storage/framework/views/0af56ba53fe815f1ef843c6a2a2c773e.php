<!DOCTYPE html>
<html>
<head>

</head>
<body style="text-align: center;">
<div style="max-width: 600px; margin: 0 auto; text-align: left;">
    <p>
        Hi <b><?php echo e($name); ?></b>,
    </p>

    <p>
        We've received a request to login into your account.
    </p>

    <p>
        If you didn't make the request, just ignore this message. Otherwise, you can login into your account.
    </p>
    
    <p>
        <strong>The OTP to login into your account is:</strong>  
    </p>
    
    <h2 style="background: #00466a; width: max-content; padding: 0 10px; color: #fff; border-radius: 4px; margin: 0 auto;"> <?php echo e($otp); ?></h2>
</div>

</body>
</html>
<?php /**PATH C:\Users\suraj\Downloads\Lead management\resources\views/otpemailLogin.blade.php ENDPATH**/ ?>