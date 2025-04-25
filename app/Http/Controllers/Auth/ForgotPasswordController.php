<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendTempPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Generate temporary password
        $tempPassword = Str::random(10);
        
        // Update user with temporary password and set isactive to 'N'
        $user->password = Hash::make($tempPassword);
        $user->password_changed = 0;
        $user->save();

        // Store temporary password in PASSWORD_RESETS table
        DB::table('PASSWORD_RESETS')->insert([
            'EMAIL' => $user->email,
            'TEMP_PASSWORD' => $tempPassword,
            'CREATED_AT' => now()
        ]);

        // Send temporary password email using PHPMailer
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
            $mail->addAddress($user->email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Temporary Password';
            $mail->Body = view('emails.temp-password', ['tempPassword' => $tempPassword])->render();

            $mail->send();
            return back()->with('status', 'A temporary password has been sent to your email address.');
        } catch (Exception $e) {
            return back()->withErrors(['email' => 'Unable to send temporary password. Please try again.']);
        }
    }
} 