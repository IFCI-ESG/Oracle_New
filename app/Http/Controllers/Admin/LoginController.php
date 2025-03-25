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
     protected $guard = 'admin';  // Use 'admin' guard for login

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

        // Check if the decrypted ID is an email or PAN
        $isEmail = filter_var($decryptedId, FILTER_VALIDATE_EMAIL);
        $isPan = preg_match('/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/', $decryptedId);

        if (!$isEmail && !$isPan) {
            return back()->withErrors([
                'email' => 'Invalid email or PAN format',
            ]);
        }

        $remember = $request->has('remember') ? true : false;

        if ($isPan) {
            // Handle PAN authentication
            $request->merge([
                'identity' => $decryptedId,
                'pan' => $decryptedId,
                'password' => $decryptedPwd,
            ]);

            $credentials = $request->only('pan', 'password');

            if (Auth::guard('web')->attempt($credentials, $remember)) {
                $user = Auth::guard('web')->user();
                if ($user->password_changed == '0') {
                    session(['force_password_change' => true]);
                } else {
                    session(['force_password_change' => false]);
                }
                return redirect()->route('home');
            }
        } else {
            // Handle email authentication
            $request->merge([
                'identity' => $decryptedId,
                'email' => $decryptedId,
                'password' => $decryptedPwd,
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $user = Auth::guard('admin')->user();
                if ($user->password_changed == '0') {
                    session(['force_password_change' => true]);
                } else {
                    session(['force_password_change' => false]);
                }
                return redirect()->route('admin.home');
            }
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
}
