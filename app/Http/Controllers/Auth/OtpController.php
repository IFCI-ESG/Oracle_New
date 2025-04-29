<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class OTPController extends Controller
{
    public function checkCredentials(Request $request)
    {
        try {
            $identity = $request->input('identity');
            $password = $request->input('password');

            // Check if identity is email or PAN
            $user = null;
            if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
                $user = DB::connection('oracle')->table('users')->where('email', $identity)->first();
            } else {
                $user = DB::connection('oracle')->table('users')->where('pan', $identity)->first();
            }

            // Generate OTP
            $otp = '987654'; // Static OTP as requested
            
            // Store OTP in Oracle database
            DB::connection('oracle')->table('otp')->insert([
                'userid' => $user ? $user->id : 1, // If user not found, use default ID 1
                'otp' => $otp,
                'otpfor' => 'LOGIN',
                'validfrom' => Carbon::now()->format('Y-m-d H:i:s'),
                'validto' => Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('OTP Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error processing request: ' . $e->getMessage()
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $identity = $request->input('identity');
            $otp = $request->input('otp');

            // Check if identity is email or PAN
            $user = null;
            if (filter_var($identity, FILTER_VALIDATE_EMAIL)) {
                $user = DB::connection('oracle')->table('users')->where('email', $identity)->first();
            } else {
                $user = DB::connection('oracle')->table('users')->where('pan', $identity)->first();
            }

            // Verify OTP from Oracle database
            $otpRecord = DB::connection('oracle')->table('otp')
                ->where('userid', $user ? $user->id : 1)
                ->where('otp', $otp)
                ->where('otpfor', 'LOGIN')
                ->where('validto', '>', Carbon::now()->format('Y-m-d H:i:s'))
                ->first();

            if (!$otpRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired OTP'
                ]);
            }

            // Insert a new OTP entry after verification
            DB::connection('oracle')->table('otp')->insert([
                'userid' => $user ? $user->id : 1,
                'otp' => $otp,
                'otpfor' => 'LOGIN_VERIFIED',
                'validfrom' => Carbon::now()->format('Y-m-d H:i:s'),
                'validto' => Carbon::now()->addMinutes(5)->format('Y-m-d H:i:s')
            ]);

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('OTP Verification Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error verifying OTP: ' . $e->getMessage()
            ]);
        }
    }

    public function sendOTP(Request $request)
    {
        try {
            $email = $request->email;
            $otp = $request->otp;

            $mail = new PHPMailer(true);
            
            // Server settings
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
                                <h1 style='margin: 0; color: #296243; letter-spacing: 5px;'>{$otp}</h1>
                            </div>
                            <p>This OTP will expire in 10 minutes.</p>
                            <p>If you did not request this password reset, please ignore this email.</p>
                            <p style='margin-top: 30px;'>Best regards,<br>ESG Portal Team</p>
                        </div>
                    </div>
                </div>
            ";
            $mail->AltBody = "Your OTP for password reset is: {$otp}";
            
            $mail->send();
            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (\Exception $e) {
            \Log::error('OTP Email Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to send OTP: ' . $e->getMessage()], 500);
        }
    }

    
} 