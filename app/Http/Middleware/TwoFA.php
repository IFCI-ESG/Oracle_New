<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\SMS;
use Session;
use Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;

class TwoFA
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user->mobile_verified_at) {
            if ($user->isotpverified) {
                return $next($request);
            } else {

                if(Session::get('loginOTP'))
				{
					$otpTime = Carbon::parse(Session::get('loginOTPTime'));
					//$otpTime2 = Carbon::now()->subSeconds(60);
					//dd($otpTime);
					
					
					if($otpTime->gte(Carbon::now()->subSeconds(60)))
					{ 
						$msg = 'OTP already generated at '.Session::get('loginOTPTime')->format('d-m-Y H:i').' and valid for 1 minute.';
						return redirect('/getotp')->withErrors([$msg]);
						
					}
					else
					{
						Session::forget('loginOTP');
						Session::forget('loginOTPTime');
					}
					
					
				}

                $response = array();
                $SMS = new SMS();

                $otp = rand(100000, 999999);

                $msg_mail = 'One Time Passowrd(OTP) for Login: ' . $otp . '. Do not share this OTP with anyone!';

                  Mail::to($user->email)
                  ->send(new OtpMail($msg_mail));
                $smsResponse = $SMS->sendSMS($otp, $user['mobile']);
                
                if ($smsResponse['error']) {
                    $response['error'] = 1;
                    $response['message'] = $smsResponse['message'];
                } else {
                    Session::put('loginOTP', $otp);
					Session::put('loginOTPTime', Carbon::now());
                    
                    $response['error'] = 0;
                    $response['message'] = 'OTP generated and sent.';
                }
                // dd($otp, $user['mobile'], $smsResponse, $smsResponse['error']);
                // Session::put('smsresponse',$smsResponse);
                return redirect('/getotp');
            }
        } else {
            $response = array();
            $SMS = new SMS();

            $otp = rand(100000, 999999);

             $msg = 'One Time Passowrd(OTP) for Mobile Verification: ' . $otp . '. Do not share this OTP with anyone!';
             Mail::to($user->email)
             ->send(new OtpMail($msg));

            $smsResponse = $SMS->sendSMS($otp, $user['mobile']);

            if ($smsResponse['error']) {
                $response['error'] = 1;
                $response['message'] = $smsResponse['message'];
            } else {
                Session::put('verifyOTP', $otp);

                $response['error'] = 0;
                $response['message'] = 'OTP generated and sent.';
            }

            return redirect('/verifymobile');
        }
    }
}
