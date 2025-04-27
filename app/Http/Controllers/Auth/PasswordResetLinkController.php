<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\AdminUser;

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
        // dd($request);
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Password::broker()->getUser(['email' => $request->email]);
        $admin = Password::broker('admins')->getUser(['email' => $request->email]);

        if (!$user && !$admin) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // Determine the correct password broker
        $broker = $user ? Password::broker() : Password::broker('admins');

        // dd($broker);

        // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.

            // $status = Password::sendResetLink(
            //     $request->only('email')
            // );

               // Send reset link
            $status = $broker->sendResetLink($request->only('email'));

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                                ->withErrors(['email' => __($status)]);

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
