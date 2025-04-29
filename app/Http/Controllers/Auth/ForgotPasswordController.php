<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        // Generate temporary password
        $tempPassword = Str::random(10);

        // Update user's password and set password_changed = 0
        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($tempPassword),
                'password_changed' => 0
            ]);

        // Store in password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'temp_password' => $tempPassword,
            'created_at' => now()
        ]);

        // Send email with temporary password using PHPMailer
        try {
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
            $mail->addAddress($request->email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset - ESG PRAKRIT Portal';
            
            // Email body with professional design
            $emailBody = "
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333333;
                    }
                    .email-container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                    }
                    .header {
                        background-color: #00bcd4;
                        padding: 20px;
                        text-align: center;
                        border-radius: 5px 5px 0 0;
                    }
                    .header h1 {
                        color: white;
                        margin: 0;
                        font-size: 24px;
                    }
                    .content {
                        background-color: #ffffff;
                        padding: 30px;
                        border: 1px solid #dedede;
                        border-radius: 0 0 5px 5px;
                    }
                    .password-container {
                        background-color: #f8f9fa;
                        padding: 15px;
                        margin: 20px 0;
                        border-radius: 5px;
                        text-align: center;
                        border: 1px dashed #00bcd4;
                    }
                    .password {
                        font-size: 24px;
                        color: #00bcd4;
                        font-weight: bold;
                        letter-spacing: 2px;
                    }
                    .warning {
                        background-color: #fff3cd;
                        color: #856404;
                        padding: 15px;
                        margin-top: 20px;
                        border-radius: 5px;
                        font-size: 14px;
                    }
                    .footer {
                        text-align: center;
                        margin-top: 20px;
                        color: #666666;
                        font-size: 12px;
                    }
                    .button {
                        background-color: #00bcd4;
                        color: white;
                        padding: 12px 25px;
                        text-decoration: none;
                        border-radius: 5px;
                        display: inline-block;
                        margin: 20px 0;
                    }
                </style>
            </head>
            <body>
                <div class='email-container'>
                    <div class='header'>
                        <h1>ESG PRAKRIT Portal</h1>
                    </div>
                    <div class='content'>
                        <p>Dear {$user->name},</p>
                        
                        <p>We received a request to reset your password for your ESG PRAKRIT Portal account. We have generated a temporary password for you.</p>
                        
                        <div class='password-container'>
                            <p style='margin-bottom: 10px;'>Your temporary password is:</p>
                            <div class='password'>{$tempPassword}</div>
                        </div>
                        
                        <p><strong>Important Instructions:</strong></p>
                        <ol>
                            <li>Use this temporary password to log in to your account</li>
                            <li>You will be required to change your password upon your first login</li>
                            <li>Please ensure to choose a strong password that you haven't used before</li>
                        </ol>
                        
                        <a href='http://141.148.214.38:8080/admin/login' class='button'>Login to Portal</a>
                        
                        <div class='warning'>
                            <strong>Security Notice:</strong> If you didn't request this password reset, please contact our support team immediately.
                        </div>
                    </div>
                    
                    <div class='footer'>
                        <p>This is an automated message, please do not reply to this email.</p>
                        <p>&copy; " . date('Y') . " ESG PRAKRIT Portal. All rights reserved.</p>
                        <p>IFCI Limited, IFCI Tower, 61 Nehru Place, New Delhi-110019</p>
                    </div>
                </div>
            </body>
            </html>";
            
            $mail->Body = $emailBody;

            $mail->send();
            return back()->with('status', 'We have emailed your temporary password.');
            
        } catch (Exception $e) {
            return back()->withErrors(['email' => 'Could not send reset password email. Please try again later.']);
        }
    }
} 
