<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PassChangeController extends Controller
{
    public function sendOTP(Request $request)
    {
        try {
            $otp = $request->otp;
            $email = $request->email;

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'apmosys.icewarpcloud.in';
            $mail->SMTPAuth = true;
            $mail->Username = 'asutosh.maharana@apmosys.com';
            $mail->Password = 'Asutosh@21396';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('esg.developer@ifciltd.com', 'ESG-PRAKRIT Portal');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset OTP - ESG Portal';
            $mail->Body = "
                <div style='font-family: Arial, sans-serif;'>
                    <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                        <div style='background-color: #296243; color: white; padding: 20px; text-align: center;'>
                            <h2 style='margin: 0;'>Password Reset OTP</h2>
                        </div>
                        <div style='padding: 20px; border: 1px solid #ddd;'>
                            <p>Dear User,</p>
                            <p>You have requested to reset your password. Please use the following OTP to proceed:</p>
                            <div style='background-color: #f8f9fa; padding: 15px; text-align: center; margin: 20px 0;'>
                                <h1 style='margin: 0; color: #296243; letter-spacing: 5px;'>" . $otp . "</h1>
                            </div>
                            <p>This OTP will expire in 10 minutes.</p>
                            <p>If you did not request this password reset, please ignore this email.</p>
                            <p style='margin-top: 30px;'>Best regards,<br>ESG Portal Team</p>
                        </div>
                    </div>
                </div>
            ";

            $mail->send();
            
            // Store OTP in session
            session(['reset_password_otp' => $otp]);
            
            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP: ' . $mail->ErrorInfo]);
        }
    }

    public function storeOTP(Request $request)
    {
        session(['reset_password_otp' => $request->otp]);
        return response()->json(['success' => true]);
    }
} 