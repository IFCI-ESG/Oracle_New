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
            // Check if user is blocked
            if ($user->isblocked == 1) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your account has been blocked. Please contact administration.'
                    ]);
                }
                return back()->withErrors([
                    'email' => 'Your account has been blocked. Please contact administration.',
                ]);
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
                DB::table('users')->where('id', $user->id)->update(['isblocked' => 1]);
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your account has been blocked due to multiple failed attempts. Please contact administration.'
                    ]);
                }
                return back()->withErrors([
                    'email' => 'Your account has been blocked due to multiple failed attempts. Please contact administration.',
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
            // Check if user is blocked
            if ($user->isblocked == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your account has been blocked. Please contact administration.'
                ]);
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
                'guard' => $guard
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
                DB::table('users')->where('id', $user->id)->update(['isblocked' => 1]);
                return response()->json([
                    'success' => false,
                    'message' => 'Your account has been blocked due to multiple failed attempts. Please contact administration.'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ]);
    }

    public function verifyOtpAndLogin(Request $request)
    {
        $storedOtp = session('login_otp');
        $credentials = session('login_credentials');

        if (!$storedOtp || !$credentials) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please try logging in again.'
            ]);
        }

        if ($request->otp !== $storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ]);
        }

        // Clear the session data
        session()->forget(['login_otp', 'login_credentials']);

        // Perform the actual login
        $key = hex2bin("0123456789abcdef0123456789abcdef");
        $iv = hex2bin("abcdef9876543210abcdef9876543210");

        $decryptedId = openssl_decrypt($request->encryptedIdentity, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedId = trim($decryptedId);
        $decryptedPwd = openssl_decrypt($request->encryptedPassword, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decryptedPwd = trim($decryptedPwd);

        $isEmail = filter_var($decryptedId, FILTER_VALIDATE_EMAIL);

        $request->merge([
            'identity' => $decryptedId,
            'email' => $isEmail ? $decryptedId : null,
            'pan' => !$isEmail ? $decryptedId : null,
            'password' => $decryptedPwd,
        ]);

        $credentials = $isEmail ? $request->only('email', 'password') : $request->only('pan', 'password');
        $guard = $isEmail ? 'admin' : 'web';

        if (Auth::guard($guard)->attempt($credentials, $request->remember)) {
            $user = Auth::guard($guard)->user();
            
            if ($user->password_changed == '0') {
                session(['force_password_change' => true]);
            } else {
                session(['force_password_change' => false]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => $guard === 'admin' ? route('admin.home') : route('home')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login failed. Please try again.'
        ]);
    }
}
