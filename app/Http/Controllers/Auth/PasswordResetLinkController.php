<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // dd('d');
        // return view('auth.reset-password');
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = AdminUser::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // 1. Generate temp password
        $tempPassword = Str::random(10);

        // 2. Store in password_resets
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'temp_password' => $tempPassword,
            'created_at' => now(),
        ]);

        // 3. Update user's password and password_changed
        $user->password = bcrypt($tempPassword);
        $user->password_changed = 0;
        $user->save();

        // 4. Send email (using PHPMailer)
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
            $mail->Subject = 'Your Temporary Password for ESG-PRAKRIT Portal';

            $mail->Body = "
                <div style='font-family: Arial, sans-serif; color: #222; max-width: 600px; margin: auto;'>
                    <h2 style='color: #2d6cdf;'>ESG-PRAKRIT Portal - Temporary Password</h2>
                    <p>Dear " . htmlspecialchars($user->name ?? 'User') . ",</p>
                    <p>
                        We received a request to reset your password for your ESG-PRAKRIT Portal account.<br>
                        Please use the temporary password below to log in:
                    </p>
                    <p style='font-size: 18px; font-weight: bold; color: #2d6cdf;'>
                        Temporary Password: <span style='background: #f4f4f4; padding: 6px 12px; border-radius: 4px;'>" . htmlspecialchars($tempPassword) . "</span>
                    </p>
                    <p>
                        <strong>For your security:</strong>
                        <ul>
                            <li>Change your password immediately after logging in.</li>
                            <li>If you did not request this password reset, please contact our support team immediately.</li>
                        </ul>
                    </p>
                    <p>
                        Thank you,<br>
                        ESG-PRAKRIT Portal Team<br>
                        <a href='mailto:support@ifciltd.com'>support@ifciltd.com</a>
                    </p>
                    <hr>
                    <small style='color: #888;'>This is an automated message. Please do not reply to this email.</small>
                </div>
            ";
            $mail->AltBody = "Dear " . ($user->name ?? 'User') . ",\n\n"
                . "We received a request to reset your password for your ESG-PRAKRIT Portal account.\n"
                . "Your temporary password is: $tempPassword\n\n"
                . "For your security:\n"
                . "- Change your password immediately after logging in.\n"
                . "- If you did not request this password reset, please contact our support team immediately.\n\n"
                . "Thank you,\nESG-PRAKRIT Portal Team\nsupport@ifciltd.com";

            $mail->send();
        } catch (Exception $e) {
            return back()->withErrors(['email' => 'Could not send email. Mailer Error: ' . $mail->ErrorInfo]);
        }

        return back()->with('status', 'Temporary password sent to your email.');
    }

    public function update(Request $request)
    {
        dd($request);
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if the email belongs to a user or an admin
        $user = Password::broker()->getUser(['email' => $request->email]);
        $admin = Password::broker('admins')->getUser(['email' => $request->email]);

        if (!$user && !$admin) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // Determine the correct password broker
        $broker = $user ? Password::broker() : Password::broker('admins');

        // Attempt to reset the password
        $status = $broker->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
    }

}
