<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
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
} 