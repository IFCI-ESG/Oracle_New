<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InquiryDetails;
use App\Models\OtpTemp;
use App\Models\Otp;
use Illuminate\Support\Facades\Session;
use Validator;
use CURLFile;
use Mail;
use Auth;
use DB;


class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // dd('Hii');
    	$user = Auth::User();
        
        $corp_users = DB::table('users')
                    ->join('sector_master as sm','sm.id','users.sector_id')
                    ->join('comp_type_master as ctm','ctm.id','users.comp_type_id')
                    ->where('users.id',$user->id)
                    ->first(['users.*','sm.name as sector_name','ctm.name as com_type']);
        
        // $retail_user = DB::table('users as u')->where('id',$user->id)->first();

        // $zone = DB::table('bank_financial_details')->where('com_id',$user->id)->get();
            // dd($corp_users);
        // dd($users);
        return view('user.home',compact('user','corp_users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        
        return view('user.edit', compact('user'));
    }

   
    public function update(Request $request)
    {
        
        $user = User::find($request->id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|', 
            'mobile' => 'required|string|max:15|',
            'designation' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
        ]
    );
    
        if ($user) {

            $emailExists = User::where('email', $request->email)
            ->where('id', '!=', $user->id)
            ->exists();

            $mobileExists = User::where('mobile', $request->mobile)
             ->where('id', '!=', $user->id)
             ->exists();

            if ($emailExists) {
             return redirect()->back()->with('error', 'The email has already been taken by another user.');
            }

            if ($mobileExists) {
             return redirect()->back()->with('error', 'The mobile number is already registered with another account.');
            }
            
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->designation = $request->input('designation');
            $user->contact_person = $request->input('contact_person');
            $user->save();
            
            return redirect()->back()->with('success', 'Profile Updated Successfully');
        }
    
        return redirect()->back()->with('error', 'User not found');
    }
    


    public function verifyUser()
    {
        return view('auth.verifyuser');
    }

    public function home()
    {
        // dd('Hii');
        return view('landing.home');
    }

    public function about_esg()
    {
        return view('landing.about_esg');
    }
    public function about_ifci()
    {
        return view('landing.about_ifci');
    }
    public function about_teri()
    {
        return view('landing.about_teri');
    }

    public function key_policy()
    {
        return view('landing.key_policy');
    }

    public function panchamrit()
    {
        return view('landing.panchamrit');
    }

    public function contact()
    {
        $services_mast = DB::table('services_master')->where('status','1')->orderby('id')->get();

        return view('landing.contact-us',compact('services_mast'));
    }

    public function inquiryMail(Request  $request)
    {
        // dd($request);
        $valid = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits:10',
            'services' => 'nullable|array',
            'services.*' => 'exists:services_master,id',
        ]);

        if($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }
        //    try{
            DB::transaction(function () use ($request)
            {
                // dd($request);
                $inquiry = new InquiryDetails;
                    $inquiry->name =  $request->name;
                    $inquiry->email = $request->email;
                    $inquiry->services = implode(',', $request->services);
                    $inquiry->mobile = $request->mobile;
                    $inquiry->message = $request->message;
                $inquiry->save();

                $serviceIds = $request->services;
                $services = DB::table('services_master')->whereIn('id', $serviceIds)->pluck('services'); // Fetch service names
                $serviceNames = $services->implode(',');
                // dd($serviceNames);

                // $data = array('name'=>$request->name,'email'=>$request->email,'services'=>$serviceNames,'mobile'=>$request->mobile,
                //              'msg'=>$request->message);

                //             //  dd($data);

                // Mail::send('emails.inquiry_mail', $data, function($message) use($data) {
                //    $message->to('esg@ifciltd.com')->subject
                //        ('Inquiry | ESG - PRAKRIT ');
                //         // $message->cc('pliwg@ifciltd.com');
                //         // $message->bcc('shweta.rai@ifciltd.com');
                //   });

                // Mail::send('emails.inquiry_thanks', $data, function($message) use($data) {
                // $message->to($data ['email'],$data ['name'])->subject
                //     ('Thank you for contacting | ESG - PRAKRIT ');
                //         // $message->cc('pliwg@ifciltd.com');
                //         // $message->bcc('shweta.rai@ifciltd.com');
                // });

            });
            // dd('s');
            return redirect()->back()->with('success', 'Thank you for your inquiry. You will receive a response once the inquiry has been reviewed.');
            // alert()->success('Your Inquiry has been registered', 'Success!')->persistent('Close');
            // return redirect()->back();
        // } catch (\Exception $e) {
        //     $valid->errors()->add('customError',"Something went wrong. Please try again after some time");
        //        return redirect()->back()->withErrors($valid);
        // }
    }

    public function calculator()
    {
        $ques_mast = DB::table('calculator_ques_master')->where('status','1')->orderby('id')->get();
        $subques_mast = DB::table('calculator_subques_master')->where('status','1')->orderby('id')->get();

        return view('landing.calculator',compact('ques_mast','subques_mast'));
    }

    public function sendOtp(Request $request)
    {

        // dd($request->mobile);
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
            'name'   => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        // Generate OTP (4 or 6 digit)
        $otp = rand(1000, 9999);

        // Store OTP in session (or database)
        Session::put('otp_' . $request->mobile, $otp);
        Session::put('otp_expiry_' . $request->mobile, now()->addMinutes(5)); // Expire in 5 mins

        $SMS = new OtpTemp();
        $module = "to find your carbon footprint";
        $smsResponse = $SMS->sendSMS($request->mobile, $module, $otp);

        // **Simulate OTP Sending** (Replace with SMS API)
        // \Log::info("OTP for {$request->mobile}: $otp"); // For debugging

        return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
    }

    // Verify OTP Function
    public function verifyOtp(Request $request)
    {
        // Validate request
        // dd($request);
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/',
            'otp'    => 'required|digits:4'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $storedOtp = Session::get('otp_' . $request->mobile);
        $otpExpiry = Session::get('otp_expiry_' . $request->mobile);

        // dd($storedOtp,$otpExpiry,$request->otp);

        if (!$storedOtp || now()->greaterThan($otpExpiry)) {
            return response()->json(['success' => false, 'message' => 'OTP expired. Please resend.']);
        }

        if ($storedOtp != $request->otp) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
        }

        // OTP Verified - Clear session
        Session::forget('otp_' . $request->mobile);
        Session::forget('otp_expiry_' . $request->mobile);

        $mobileExists = Otp::where('mobile', $request->mobile)->exists();

        if(!$mobileExists){
            $otp_data = new Otp;
                $otp_data->name = $request->name;
                $otp_data->mobile   = $request->mobile;
            $otp_data->save();
        }

        return response()->json(['success' => true, 'message' => 'OTP verified successfully']);
    }

    public function faq()
    {
        return view('landing.faq');
    }

    public function tool()
    {
        return view('landing.tool');
    }

}
