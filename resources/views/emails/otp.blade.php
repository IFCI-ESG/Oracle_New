<!DOCTYPE html>
<html>
<head>
    <title>OTP for {{ $otpFor }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2d3748;">ESG-PRAKRIT Portal - OTP Verification</h2>
        <p>Hello,</p>
        <p>Your One Time Password (OTP) for {{ $otpFor }} is:</p>
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: center;">
            <h1 style="color: #4a5568; margin: 0; letter-spacing: 5px;">{{ $otp }}</h1>
        </div>
        <p>This OTP is valid for 2 minutes only.</p>
        <p style="color: #718096; font-size: 14px;">
            Note: Please do not share this OTP with anyone. This is meant for your secure access only.
        </p>
        <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 20px 0;">
        <p style="color: #718096; font-size: 12px;">
            This is an automated email. Please do not reply to this message.
        </p>
    </div>
</body>
</html> 