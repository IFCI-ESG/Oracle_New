<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\AdminUser;
use Auth;
use DB;
use PHPMailer\PHPMailer\PHPMailer;

class LoginController extends Controller
{
     protected $guard = 'admin';  

    public function showLoginForm()
    {
        return view('auth.adminlogin');
    }

    public function login(Request $request)
    {
        $key = hex2bin("0123456789abcdef0123456789abcdef");
        $iv = hex2bin("abcdef9876543210abcdef9876543210");

        $decryptedId = openssl_decrypt($request->encryptedIdentity, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedId = trim($decryptedId);
        $decryptedPwd = openssl_decrypt($request->encryptedPassword, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedPwd = trim($decryptedPwd);

        $isEmail = filter_var($decryptedId, FILTER_VALIDATE_EMAIL);
        $isPan = preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $decryptedId);

        if (!$isEmail && !$isPan) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or PAN format'
                ]);
            }
            return back()->withErrors([
                'email' => 'Invalid email or PAN format',
            ]);
        }

        // Find user by email or PAN
        $user = null;
        if ($isEmail) {
            $user = DB::table('users')->where('email', $decryptedId)->first();
        } else {
            $user = DB::table('users')->where('pan', $decryptedId)->first();
        }

        if ($user) {
            // Check if user is blocked and attempt to unblock if 10 minutes have passed
            if ($user->isblocked == 1) {
                if ($this->checkAndUnblockUser($user)) {
                    // User was unblocked, continue with login
                    $user->isblocked = 0;
                } else {
                    // Format remaining time in a user-friendly way
                    $remainingTime = $this->formatRemainingTime($user->blocked_at);
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => "Your account is temporarily blocked. Please try again after {$remainingTime}."
                        ]);
                    }
                    return back()->withErrors([
                        'email' => "Your account is temporarily blocked. Please try again after {$remainingTime}."
                    ]);
                }
            }
        }

        $remember = $request->has('remember') ? true : false;

        if ($isPan) {
            $request->merge([
                'identity' => $decryptedId,
                'pan' => $decryptedId,
                'password' => $decryptedPwd,
            ]);

            $credentials = $request->only('pan', 'password');

            if (Auth::guard('web')->attempt($credentials, $remember)) {
                // Reset login attempts on successful login
                DB::table('users')->where('id', $user->id)->update(['login_attempts' => 0]);
                
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Credentials validated successfully'
                    ]);
                }

                $user = Auth::guard('web')->user();
                if ($user->password_changed == '0') {
                    session(['force_password_change' => true]);
                } else {
                    session(['force_password_change' => false]);
                }
                return redirect()->route('home');
            }
        } else {
            $request->merge([
                'identity' => $decryptedId,
                'email' => $decryptedId,
                'password' => $decryptedPwd,
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                // Reset login attempts on successful login
                DB::table('users')->where('id', $user->id)->update(['login_attempts' => 0]);
                
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Credentials validated successfully'
                    ]);
                }

                $user = Auth::guard('admin')->user();
                if ($user->password_changed == '0') {
                    session(['force_password_change' => true]);
                } else {
                    session(['force_password_change' => false]);
                }
                return redirect()->route('admin.home');
            }
        }

        // Increment failed login attempts
        if ($user) {
            $newAttempts = $user->login_attempts + 1;
            DB::table('users')->where('id', $user->id)->update(['login_attempts' => $newAttempts]);

            // Block user after 3 failed attempts
            if ($newAttempts >= 3) {
                $this->blockUser($user);
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your account has been temporarily blocked due to multiple failed attempts. Please try again after 10 minutes.'
                    ]);
                }
                return back()->withErrors([
                    'email' => 'Your account has been temporarily blocked due to multiple failed attempts. Please try again after 10 minutes.',
                ]);
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    private function formatRemainingTime($blockedAt)
    {
        $now = now();
        $blockedAt = \Carbon\Carbon::parse($blockedAt);
        $blockExpiryTime = $blockedAt->copy()->addMinutes(10); // Use copy() to prevent modifying original time
        
        // If block has expired
        if ($now->greaterThanOrEqualTo($blockExpiryTime)) {
            return "0 seconds";
        }

        $remainingSeconds = $now->diffInSeconds($blockExpiryTime, false); // Use false to get remaining time
        $minutes = floor($remainingSeconds / 60);
        $seconds = $remainingSeconds % 60;

        if ($minutes > 0) {
            return $minutes . " minute" . ($minutes > 1 ? "s" : "") . 
                   ($seconds > 0 ? " " . $seconds . " second" . ($seconds > 1 ? "s" : "") : "");
        }
        
        return $seconds . " second" . ($seconds > 1 ? "s" : "");
    }

    private function checkAndUnblockUser($user)
    {
        if ($user->isblocked && $user->blocked_at) {
            $blockedAt = \Carbon\Carbon::parse($user->blocked_at);
            $blockExpiryTime = $blockedAt->copy()->addMinutes(10);
            $now = now();
            
            // If block period has expired
            if ($now->greaterThanOrEqualTo($blockExpiryTime)) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'isblocked' => 0,
                        'blocked_at' => null,
                        'login_attempts' => 0
                    ]);
                return true;
            }
            return false;
        }
        return false;
    }

    public function validateCredentials(Request $request)
    {
        $key = hex2bin("0123456789abcdef0123456789abcdef");
        $iv = hex2bin("abcdef9876543210abcdef9876543210");

        $decryptedId = openssl_decrypt($request->encryptedIdentity, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedId = trim($decryptedId);
        $decryptedPwd = openssl_decrypt($request->encryptedPassword, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedPwd = trim($decryptedPwd);

        $isEmail = filter_var($decryptedId, FILTER_VALIDATE_EMAIL);
        $isPan = preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $decryptedId);

        if (!$isEmail && !$isPan) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or PAN format'
            ]);
        }

        // Find user by email or PAN
        $user = null;
        if ($isEmail) {
            $user = DB::table('users')->where('email', $decryptedId)->first();
        } else {
            $user = DB::table('users')->where('pan', $decryptedId)->first();
        }

        if ($user) {
            // Check if user is blocked and attempt to unblock if 10 minutes have passed
            if ($user->isblocked == 1) {
                if ($this->checkAndUnblockUser($user)) {
                    // User was unblocked, continue with login
                    $user->isblocked = 0;
                } else {
                    // Format remaining time in a user-friendly way
                    $remainingTime = $this->formatRemainingTime($user->blocked_at);
                    return response()->json([
                        'success' => false,
                        'message' => "Your account is temporarily blocked. Please try again after {$remainingTime}."
                    ]);
                }
            }
        }

        $request->merge([
            'identity' => $decryptedId,
            'email' => $isEmail ? $decryptedId : null,
            'pan' => $isPan ? $decryptedId : null,
            'password' => $decryptedPwd,
        ]);

        $credentials = $isEmail ? $request->only('email', 'password') : $request->only('pan', 'password');
        $guard = $isEmail ? 'admin' : 'web';

        if (Auth::guard($guard)->validate($credentials)) {
            // Reset login attempts on successful validation
            if ($user) {
                DB::table('users')->where('id', $user->id)->update(['login_attempts' => 0]);
            }

            // Generate and store OTP
            $otp = '987654'; // Static OTP as per your requirement
            session(['login_otp' => $otp]);
            session(['login_credentials' => [
                'identity' => $decryptedId,
                'password' => $decryptedPwd,
                'remember' => $request->remember,
                'guard' => $guard,
                'userid' => $user->id // Store user ID in session
            ]]);

            return response()->json([
                'success' => true,
                'message' => 'Credentials validated successfully'
            ]);
        }

        // Increment failed login attempts
        if ($user) {
            $newAttempts = $user->login_attempts + 1;
            DB::table('users')->where('id', $user->id)->update(['login_attempts' => $newAttempts]);

            // Block user after 3 failed attempts
            if ($newAttempts >= 3) {
                $this->blockUser($user);
                return response()->json([
                    'success' => false,
                    'message' => 'Your account has been temporarily blocked due to multiple failed attempts. Please try again after 10 minutes.'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ]);
    }

    private function blockUser($user)
    {
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'isblocked' => 1,
                'blocked_at' => now(),
                'login_attempts' => 3
            ]);
    }

    public function resendOtp(Request $request)
    {
        $key = hex2bin("0123456789abcdef0123456789abcdef");
        $iv = hex2bin("abcdef9876543210abcdef9876543210");

        $decryptedId = openssl_decrypt($request->encryptedIdentity, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedId = trim($decryptedId);
        $decryptedPwd = openssl_decrypt($request->encryptedPassword, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedPwd = trim($decryptedPwd);

        $isEmail = filter_var($decryptedId, FILTER_VALIDATE_EMAIL);
        $isPan = preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $decryptedId);

        if (!$isEmail && !$isPan) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid email or PAN format'
            ]);
        }

        // Find user by email or PAN
        $user = null;
        if ($isEmail) {
            $user = DB::table('users')->where('email', $decryptedId)->first();
        } else {
            $user = DB::table('users')->where('pan', $decryptedId)->first();
        }

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }

        // Check if user is blocked
        if ($user->isblocked == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Your account has been blocked. Please contact administration.'
            ]);
        }

        try {
            // Generate random 6-digit OTP
            $randomOtp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Store OTP in database
            DB::table('otp')->insert([
                'userid' => $user->id,
                'otp' => $randomOtp,
                'otpfor' => 'LOGIN',
                'validfrom' => now(),
                'validto' => now()->addMinutes(2)
            ]);

            // Send email with OTP
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
            $mail->Subject = 'ESG-PRAKRIT Portal - Login OTP';
            $mail->Body = view('emails.otp', ['otp' => $randomOtp, 'otpFor' => 'Login'])->render();

            $mail->send();

            // Store both OTPs in session
            session(['login_otp' => ['random' => $randomOtp, 'static' => '987654']]);
            session(['login_credentials' => [
                'identity' => $decryptedId,
                'password' => $decryptedPwd,
                'remember' => $request->remember,
                'guard' => $isEmail ? 'admin' : 'web',
                'userid' => $user->id // Store user ID in session
            ]]);

            return response()->json([
                'success' => true,
                'message' => 'New OTP has been sent successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('OTP Send Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ]);
        }
    }

    public function verifyOtpAndLogin(Request $request)
    {
        $storedOtps = session('login_otp');
        $credentials = session('login_credentials');

        \Log::info('Verifying OTP:', [
            'entered_otp' => $request->otp,
            'stored_otps' => $storedOtps,
            'has_credentials' => !empty($credentials)
        ]);

        if (!$storedOtps || !$credentials) {
            \Log::error('Session data missing', [
                'has_stored_otps' => !empty($storedOtps),
                'has_credentials' => !empty($credentials)
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please try logging in again.'
            ]);
        }

        // First check if OTP exists in database and is valid
        $validOtp = DB::table('otp')
            ->where('userid', $credentials['userid'])
            ->where('otp', $request->otp)
            ->where('otpfor', 'LOGIN')
            ->where('validto', '>=', now())
            ->orderBy('id', 'desc')
            ->first();

        \Log::info('Database OTP check:', [
            'found_valid_otp' => !empty($validOtp),
            'user_id' => $credentials['userid'],
            'otp' => $request->otp
        ]);

        // If OTP is valid in database or matches static OTP
        if ($validOtp || $request->otp === $storedOtps['static']) {
            // Clear the session data
            session()->forget(['login_otp', 'login_credentials']);

            // Perform the actual login
            if (Auth::guard($credentials['guard'])->attempt([
                $credentials['guard'] === 'admin' ? 'email' : 'pan' => $credentials['identity'],
                'password' => $credentials['password']
            ])) {
                $user = Auth::guard($credentials['guard'])->user();
                
                if ($user->password_changed == '0') {
                    session(['force_password_change' => true]);
                } else {
                    session(['force_password_change' => false]);
                }

                return response()->json([
                    'success' => true,
                    'redirect' => route($credentials['guard'] === 'admin' ? 'admin.home' : 'home')
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Login failed. Please try again.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP'
        ]);
    }
}

