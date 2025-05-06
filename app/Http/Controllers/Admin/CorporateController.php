<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Validator;
use Mail;

class CorporateController extends Controller
{

    public function adminhome() {
        $user = Auth::User();
        $users = DB::table('users')
         ->where('users.id',$user->id)
         ->first(['users.*']);

        // Get service names if user has services
        $servicesString = '';
        if ($users && $users->services) {
            $serviceIds = json_decode($users->services, true);
            if ($serviceIds) {
                $services = DB::table('servicemaster')
                    ->whereIn('id', $serviceIds)
                    ->pluck('services')
                    ->toArray();
                $servicesString = implode(', ', $services);
            }
        }

        return view('admin.user.adminhome',compact('user','users', 'servicesString'));
    }

    public function dataupdate(Request $request)
    {

        $user = AdminUser::find($request->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
            'designation' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'pan' => ['nullable', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],
            'ifsc_code' => ['required', 'regex:/^[A-Z]{4}0[A-Z0-9]{6}$/'], // Regex for IFSC code
        ], [
            'pan.regex' => 'The PAN number must be in the correct format (e.g., ABCDE1234F).',
            'ifsc_code.regex' => 'The IFSC code must be in the correct format (e.g., ABCD0123456).',
        ]);


        if ($user) {

            $emailExists = AdminUser::where('email', $request->email)
            ->where('id', '!=', $user->id)
            ->exists();

            $mobileExists = AdminUser::where('mobile', $request->mobile)
             ->where('id', '!=', $user->id)
             ->exists();

             $ifscExists = AdminUser::where('ifsc_code', $request->ifsc_code)
             ->where('id', '!=', $user->id)
             ->exists();

            if ($emailExists) {
             return redirect()->back()->with('error', 'The email has already been taken by another user.');
            }

            if ($mobileExists) {
             return redirect()->back()->with('error', 'The mobile number is already registered with another account.');
            }

            if($ifscExists) {
                return redirect()->back()->with('error', 'The IFSC Code is already been taken by another account.');
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->designation = $request->input('designation');
            $user->pan = $request->input('pan');
            $user->ifsc_code = $request->input('ifsc_code');
            $user->contact_person = $request->input('contact_person');
            $user->save();

            return redirect()->back()->with('success', 'Profile Updated Successfully');
        }

        return redirect()->back()->with('error', 'User not found');
    }

    public function updateAccount(Request $request) {
      try {

        $user = AdminUser::find(auth()->user()->id);

        if($user->password_changed == 1) {
           $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
           ]);
        }

        if ($request->has('reset_password')) {
            $request->validate([
                'new_password'     => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
                'otp'              => 'required|numeric',
            ]);

        // $SMS = new OtpTemp();
        // $module = "to update your account";
        // $smsResponse = $SMS->sendSMS($request->mobile, $module, $otp);

            $validOtp = '987654';

            if ($request->otp != $validOtp) {
                return redirect()->back()->with('error', 'Invalid OTP!');
            }
        }

        if (! $user) {
            return redirect()->back()->with('error', 'User not found!');
        }
        if($user->password_changed == 1){
         $user->email = $request->email;
        }

        if ($request->has('reset_password')) {
            $user->password = Hash::make($request->new_password);

            $user->password_changed = 1;
            $user->save();
            Auth::Logout($user);
            return redirect('/admin/login')->with('success', 'Password updated. Please log in.');
        }


        if($user->password_changed == 1){
        if  ( $request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $imageName, 'public');
            $user->image = 'images/' . $imageName;
        }
    }


        $user->save();

        return redirect()->back()->with([
            'success' => 'Account updated successfully!',
            'password_changed' => 1
        ]);

     } catch (\Exception $e) {
        Log::error('Error in updating account: ' . $e->getMessage(), [
            'exception' => $e,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('error', 'Please upload Only JPG, JPEG & PNG image format!');
    }
}

   public function activate($id)
    {

        $id = decrypt($id);

        $user = AdminUser::find($id);

        if ($user) {
            $user->isactive = 'Y';
            $user->save();

            return redirect()->back()->with('success', 'Bank activated successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }

    public function deactivate($id)
    {
        $id = decrypt($id);

        $user = AdminUser::find($id);

        if ($user) {
            $user->isactive = 'N';
            $user->save();

            return redirect()->back()->with('success', 'Bank deactivated successfully.');
        }

        return redirect()->back()->with('error', 'User not found.');
    }
    public function index()
    {
        // dd('d');

        $user = Auth::user();
        $corp_details = DB::table('users')
                        ->where('created_by', $user->id)
                        ->where('borrower_type', 'CR')
                        ->orderby('id','desc')->get();

        return view('admin.corporate.index', compact('corp_details'));

    }

    public function create()
    {
        // dd('c');
        $services = DB::table('servicemaster')->get();
        $sectors = DB::table('sector_master')->orderby('id')->get();
        $type = DB::table('comp_type_master')->orderby('id')->get();

        return view('admin.corporate.addcorporate', compact('services','sectors','type'));

    }

    public function apidata($pan)
    {
        // dd($pan);
        $valid = Validator::make(['pan' => $pan],[
            'pan' => 'required|regex:/^([A-Za-z]{5})([0-9]{4})([A-Za-z]{1})$/'
        ]);

        if($valid->fails()) {
            return back()->withErrors($valid)->withInput();
        }

        $panExists = AdminUser::where('pan', $pan)->exists();


        if($panExists)
        {
            $user=AdminUser::where('pan', $pan)->first();

            alert()->success('This Company is already Registered', 'Data Fetched!')->persistent('Close');
            // return redirect()->route('admin.user.existuser',['id' => encrypt($user->id)]);
        }



        // Sandbox details
        // $urlcin = 'https://api.probe42.in/probe_pro_sandbox/companies/'.$cin.'/base-details'
        $url = 'https://api.probe42.in/probe_pro_sandbox/companies/'.$pan.'/comprehensive-details?identifier_type=PAN';
        $api_key = '07wvsOWBoq9iwpjhMm2C22eKOymlpqht9WmtYEFb';

        // Production Details
        // API URL
        // $url = 'https://api.probe42.in/probe_pro/companies/'.$pan.'/comprehensive-details?identifier_type=PAN';
        // // API Key
        // $api_key = '6NM20CtNSx6J22J4NgG6fH2bZN51hnt8EYmtRpRc';

        // Headers
        $headers = [
        'Accept: application/json',
        'x-api-key: ' . $api_key,
        'x-api-version: 1.3'
        ];

        // Initialize cURL session
        $ch = curl_init();
        // dd($ch);

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session
        $response = curl_exec($ch);
        // dd(json_decode($response));
        curl_close($ch);
        // dd($response);
        $jdecode =  json_decode($response);
        // dd($jdecode);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid response format!'
            ], 400); // Bad Request
        }
        
        if (isset($jdecode->message) && $jdecode->message === 'Company does not exist') {
            return response()->json([
                'status' => false,
                'message' => 'Company does not exist!'
            ], 404); // Not Found
        }
        
        if (!isset($jdecode->data)) {
            return response()->json([
                'status' => false,
                'message' => 'No Data Found!'
            ], 204); // No Content
        }
        
        // Success case
        return response()->json([
            'status' => true,
            'message' => 'Company data fetched successfully.',
            'data' => $jdecode->data
        ]);   
    }

    public function store(Request $request)
    {
    // dd($request);
    $validator = Validator::make($request->all(), [

        'pan' => 'required|string',
        'corp_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        'cin' => 'required',
        'corp_email' => 'required|email',
        'reg_off_add' => 'required|string',
        'reg_off_pin' => 'required',
        'reg_off_state' => 'required|string',
        'reg_off_city' => 'required|string',
        'sector_type' => 'required',
        'comp_type' => 'required',
        'designation' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        'license_key' => 'required|string',
        'valid_from' => 'required|date',
        'valid_to' => 'required|date|after_or_equal:valid_from',
        'contact_person' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        'mobile' => 'required|digits:10|regex:/^[0-9]{10}$/',
        'services' => 'nullable|array',
        'services.*' => 'exists:servicemaster,id',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $userInput = $request->all();

    array_walk_recursive($userInput, function (&$userInput) {
        $userInput = strip_tags($userInput);
    });
    $request->merge($userInput);

    $user = Auth::user();

    // Check for duplicate email, mobile, or PAN
    $emailExists = AdminUser::where('email', $request->email)->orWhere('mobile', $request->mobile)->orWhere('pan', $request->pan)->exists();

    if ($emailExists) {
        return redirect()->back()->withErrors(['message' => 'Email, Mobile should be unique! These are already Registered'])->withInput();
    }

    $newuser = new AdminUser;

    $newuser->pan = $request->pan;
    $newuser->name = $request->corp_name;
    $newuser->cin_llpin = $request->cin;
    $newuser->email = $request->corp_email;
    $newuser->reg_off_add = $request->reg_off_add;
    $newuser->reg_off_pin = $request->reg_off_pin;
    $newuser->reg_off_state = $request->reg_off_state;
    $newuser->reg_off_city = $request->reg_off_city;
    $newuser->borrower_type = 'CR';
    $newuser->sector_id = $request->sector_type;
    $newuser->comp_type_id = $request->comp_type;
    $newuser->designation = $request->designation;
    $newuser->license_key = $request->license_key;
    $newuser->valid_from = $request->valid_from;
    $newuser->valid_to = $request->valid_to;
    $newuser->mobile = $request->mobile;
    $newuser->altr_mobile = $request->altr_mobile ? $request->altr_mobile : null;
    $newuser->contact_person = $request->contact_person;
    $newuser->services = json_encode($request->services);
    $newuser->status = 'D';
    $newuser->isactive = 'N';
    $newuser->created_by = $user->id;

    DB::transaction(function () use ($newuser, $request) {
        $newuser->save();

        // Insert data into corporate_master table
        // $corporateData = [
        //     'name' => $request->bank_name, // Name from bank_name in the form
        //     'email' => $request->email,
        //     'ifsc_code' => $request->ifsc_code,
        //     'pan' => $request->pan,
        //     'mobile' => $request->mobile,
        // ];

        // DB::table('corporate_master')->insert($corporateData);
    });

    // session()->flash('success', 'Data saved successfully!');
    alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
    return redirect()->route('admin.corp_admin.edit', ['id' => encrypt($newuser->id)]);
}

    private function generateRandomString($length = 5)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $charactersLength = strlen($characters);
        $randomString     = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    private function generateUserId($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return 'ESGADM' . strtoupper($randomString); // Prefix with ESG
    }

    public function edit($id)
    {
        // dd($id);
        $id             = decrypt($id);
        $services       = DB::table('servicemaster')->get();
        $corp_details   = AdminUser::find($id);
        $storedServices = json_decode($corp_details->services, true);
        $sectors = DB::table('sector_master')->orderby('id')->get();
        // dd($corp_details,$services);
        return view('admin.corporate.editcorporate', compact('corp_details', 'storedServices', 'services','sectors'));

    }
    public function view($id)
    {
        $id             = decrypt($id);
        $services       = DB::table('servicemaster')->get();
        $bank_details   = AdminUser::find($id);
        $storedServices = json_decode($bank_details->services, true);
        // dd($bank_details,$services);
        return view('admin.corporate.viewcorporate', compact('bank_details', 'storedServices', 'services'));

    }

    public function update(Request $request)
    {
        // dd($request);
        // try{
            $validator = Validator::make($request->all(), [
                'pan' => 'required|string',
                'corp_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'cin' => 'required',
                'corp_email' => 'required|email',
                'reg_off_add' => 'required|string',
                'reg_off_pin' => 'required',
                'reg_off_state' => 'required|string',
                'reg_off_city' => 'required|string',
                'sector_type' => 'required',
                'comp_type' => 'required',
                'designation' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'license_key' => 'required|string',
                'valid_from' => 'required|date',
                'valid_to' => 'required|date|after_or_equal:valid_from',
                'contact_person' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'mobile' => 'required|digits:10|regex:/^[0-9]{10}$/',
                'services' => 'nullable|array',
                'services.*' => 'exists:servicemaster,id',
            ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($request) {

            $user = AdminUser::find($request->user_id);
                $user->pan = $request->pan;
                $user->name = $request->corp_name;
                $user->cin_llpin = $request->cin;
                $user->email = $request->corp_email;
                $user->reg_off_add = $request->reg_off_add;
                $user->reg_off_pin = $request->reg_off_pin;
                $user->reg_off_state = $request->reg_off_state;
                $user->reg_off_city = $request->reg_off_city;
                $user->sector_id = $request->sector_type;
                $user->comp_type_id = $request->comp_type;
                $user->designation = $request->designation;
                $user->license_key = $request->license_key;
                $user->valid_from = $request->valid_from;
                $user->valid_to = $request->valid_to;
                $user->mobile = $request->mobile;
                $user->altr_mobile = $request->altr_mobile ? $request->altr_mobile : null;
                $user->contact_person = $request->contact_person;
                $user->services = json_encode($request->input('services', []));
            $user->save();

        });

        alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
        return redirect()->back()->with('success', 'Data successfully Updated');
    

        // return view('admin.user.editcorporate', compact('user'));

    }

    public function submit(Request $request)
    {
        DB::transaction(function () use ($request) {
             // Generate random secure password
            // $randomPassword = $this->generateRandomString(5); // length = 10

            // Generate unique user ID starting with ESG
            $uniqueLoginId = $this->generateUserId(6); // ESG + 6 random characters

            $randomString = 'India@1234';

            $user = AdminUser::find($request->user_id);
                $user->isactive = 'Y';
                $user->status   = 'S';
                $user->profileid  = 5;
                $user->password_changed  = 0;  //First Login
                $user->password=Hash::make($randomString);
                $user->unique_login_id= $uniqueLoginId;
            $user->save();

            $data_role1 = ['role_id' => 2, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
            $data_role2 = ['role_id' => 3, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
            $data_role2 = ['role_id' => 6, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
            DB::table('model_has_roles')->insert([$data_role1, $data_role2]);

            //  $data = array('name'=>$user->name, 'unique_id'=>$user->email, 'password'=>$randomString, 'bank_name'=>Auth::user()->name);

            //             //  dd($data);

            // Mail::send('emails.email_credentials', $data, function($message) use($data) {
            //    $message->to($data ['unique_id'],$data ['name'])
            //             ->subject('Account Created | ESG - PRAKRIT')
            //             ->attach(public_path('asset/images/logo/email_logo.png'), [
            //                 'as' => 'email_logo',
            //                 'mime' => 'image/png',
            //             ]);
            //         // $message->cc('esgprkrit@ifciltd.com');
            //         // $message->bcc('tushar.agnihotri@ifciltd.com');
            // });

        });
        alert()->success('New Corporate Created', 'Success!')->persistent('Close');
        return redirect()->route('admin.corp_admin.index');
        // return redirect()->back()->with('success', 'Data successfully Submitted');

    }

    public function com_list($bank_id)
    {
        $bank_id = decrypt($bank_id);
        // dd($bank_id);
        $user = Auth::user();
        $comp = DB::table('users')
            ->where('created_by', $bank_id)
            ->where('status', 'S')
            ->orderby('id')->get();
        // dd($comp);
        return view('admin.corporate.company_list', compact('comp'));

    }

}
