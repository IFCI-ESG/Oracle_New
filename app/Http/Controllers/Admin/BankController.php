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

class BankController extends Controller
{

    public function adminhome() {
        
        $user = Auth::User();
        $users = DB::table('users')
         ->where('users.id',$user->id)
         ->first(['users.*']);
         return view('admin.user.adminhome',compact('user','users'));
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

        $user = Auth::user();
        $bank_details = DB::table('users')
            ->where('created_by', $user->id)
            ->orderby('id')->get();

        return view('admin.bank.index', compact('bank_details'));

    }

    public function create()
    {
        $services = DB::table('services_master')->get();

        return view('admin.bank.addbank', compact('services'));

    }

    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            
            'ifsc_code' => 'required|string|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/|unique:users,ifsc_code',
            'bank_name'      => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'micr_code'            => 'required|string',
            'state'            => 'required|string',
            'district'            => 'required|string',
            'city'            => 'required|string',
            'full_address'            => 'required|string',
            'designation'    => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'pan'            => 'required|string',
            'bank_sector_type'            => 'required|string',
            'license_key'    => 'required|string',
            'valid_from'     => 'required|date',
            'valid_to'       => 'required|date|after_or_equal:valid_from',
            'contact_person' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'email'          => 'required|email',
            'mobile'         => 'required|digits:10|regex:/^[0-9]{10}$/',
            'services'       => 'nullable|array',
            'services.*'     => 'exists:services_master,id',
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

        // try {

        $emailExists = AdminUser::where('email', $request->email)->orwhere('mobile', $request->mobile)->orwhere('pan', $request->pan)->exists();


        if ($emailExists) {
            // dd($emailExists,$mobileExists);
            // alert()->error('Email, Mobile should be unique! These are already Registered', 'Attention!')->persistent('Close');
            // return redirect()->back();

            return redirect()->back()->withErrors(['message' => 'Email, Mobile should be unique! These are already Registered'])->withInput();
        }
        $newuser = new AdminUser;

        // $randomString = 'Express@2025!';
        $newuser->ifsc_code        = $request->ifsc_code;

        $newuser->name        = $request->bank_name;
        $newuser->bank_code        = $request->bank_code;
        $newuser->micr_code        = $request->micr_code;
        $newuser->state        = $request->state;
        $newuser->district        = $request->district;
        $newuser->city        = $request->city;
        $newuser->full_address        = $request->full_address;
        $newuser->pan         = $request->pan;
        $newuser->bank_sector_type         = $request->bank_sector_type;
        $newuser->license_key = $request->license_key;
        $newuser->valid_from  = $request->valid_from;
        $newuser->valid_to    = $request->valid_to;
        $newuser->email       = $request->email;
        //  $newuser->password = Hash::make($randomString);
        //$newuser->password = '$2y$10$vTj1GhEjFcL0duMu1AqmGebo48zWZoxIuG8ThKXNfEDw7ltrUobTC';    // India@1234
        $newuser->mobile         = $request->mobile;
        $newuser->altr_mobile    = $request->altr_mobile ? $request->altr_mobile : Null;
        $newuser->designation    = $request->designation;
        $newuser->contact_person = $request->contact_person;
        $newuser->services       = json_encode($request->services);
        $newuser->status         = 'D';
        $newuser->created_by     = $user->id;
        DB::transaction(function () use ($newuser) {
            $newuser->save();
        });

        // alert()->success('Record Inserted', 'Success!')->persistent('Close');
        session()->flash('success', 'Data saved successfully!');
        return redirect()->route('admin.new_admin.edit', ['id' => encrypt($newuser->id)]);
        // } catch (\Exception $e) {
        //     alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     // errorMail($e, $request->id, Auth::user()->id);
        //     return redirect()->back();
        // }
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

    public function edit($id)
    {
        $id             = decrypt($id);
        $services       = DB::table('services_master')->get();
        $bank_details   = AdminUser::find($id);
        $storedServices = json_decode($bank_details->services, true);
        // dd($bank_details,$services);
        return view('admin.bank.editbank', compact('bank_details', 'storedServices', 'services'));

    }
    public function view($id)
    {
        $id             = decrypt($id);
        $services       = DB::table('services_master')->get();
        $bank_details   = AdminUser::find($id);
        $storedServices = json_decode($bank_details->services, true);
        // dd($bank_details,$services);
        return view('admin.bank.viewbank', compact('bank_details', 'storedServices', 'services'));

    }

    public function update(Request $request)
    {
        // dd($request);
        // try{
            $validator = Validator::make($request->all(), [
                'ifsc_code' => 'required|string|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/',
                'bank_name'      => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'micr_code'            => 'required|string',
                'state'            => 'required|string',
                'district'            => 'required|string',
                'city'            => 'required|string',
                'full_address'            => 'required|string',
                'designation'    => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'pan'            => 'required|string',
                'bank_sector_type'            => 'required|string',
                'license_key'    => 'required|string',
                'valid_from'     => 'required|date',
                'valid_to'       => 'required|date|after_or_equal:valid_from',
                'contact_person' => 'required|string|regex:/^[a-zA-Z\s]+$/',
                'email'          => 'required|email',
                'mobile'         => 'required|digits:10|regex:/^[0-9]{10}$/',
                'services'       => 'nullable|array',
                'services.*'     => 'exists:services_master,id',
            ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($request) {
            $user                 = AdminUser::find($request->user_id);
            $user->ifsc_code           = $request->ifsc_code;
            $user->name           = $request->bank_name;
            $user->bank_code        = $request->bank_code;
            $user->micr_code           = $request->micr_code;
            $user->state           = $request->state;
            $user->district           = $request->district;
            $user->city           = $request->city;
            $user->full_address           = $request->full_address;
            $user->pan            = $request->pan;
            $user->bank_sector_type            = $request->bank_sector_type;
            $user->license_key    = $request->license_key;
            $user->valid_from     = $request->valid_from;
            $user->valid_to       = $request->valid_to;
            $user->email          = $request->email;
            $user->contact_person = $request->contact_person;
            $user->designation    = $request->designation;
            $user->mobile         = $request->mobile;
            $user->altr_mobile    = $request->altr_mobile ? $request->altr_mobile : Null;
            $user->services       = json_encode($request->input('services', []));
            // $purpose = $request->input('purpose', []);
            // $user->purpose = implode(',', $purpose);
            $user->save();

        });

        alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
        return redirect()->back()->with('success', 'Data successfully Updated');
        // }catch (\Exception $e)
        // {
        //     alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     return redirect()->back();
        // }

        return view('admin.user.edituser', compact('user'));

    }

    public function submit(Request $request)
    {
        // dd($request);

        // try{

        DB::transaction(function () use ($request) {
            // $randomString = $this->generateRandomString(5);
            $randomString = 'Express@2025!';

            $user = AdminUser::find($request->user_id);
            $user->isactive = 'Y';
            $user->status   = 'S';
            $user->password_changed   = 0;  //First Login
            $user->password=Hash::make($randomString);
            // $user->password = '$2y$10$vTj1GhEjFcL0duMu1AqmGebo48zWZoxIuG8ThKXNfEDw7ltrUobTC'; // India@1234

            $user->save();

            $data_role1 = ['role_id' => 2, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
            $data_role2 = ['role_id' => 3, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
            DB::table('model_has_roles')->insert([$data_role1, $data_role2]);

            // $esd_det = array('bank_user_id' =>  $user->id, 'esd' => 'ESG/'.$user->id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now());
            // DB::table('bank_esd_details')->insert($esd_det);

            // dd($user);
            // $user->password=Hash::make($randomString);
            // dd($randomString);

            // $data = array('name'=>$user->name, 'unique_id'=>$user->email, 'password'=>$randomString, 'bank_name'=>'IFCI LTD.');

            //             //  dd($data);

            // Mail::send('emails.email_credentials', $data, function($message) use($data) {
            //    $message->to($data ['unique_id'],$data ['name'])
            //             ->subject('Account Created | ESG - PRAKRIT ')
            //             ->attach(public_path('asset/images/logo/email_logo.png'), [
            //                 'as' => 'email_logo',
            //                 'mime' => 'image/png',
            //             ]);
            //         // $message->cc('pliwg@ifciltd.com');
            //         // $message->bcc('shivam.shukla@ifciltd.com');
            // });

        });
        alert()->success('New Bank Created', 'Success!')->persistent('Close');
        return redirect()->route('admin.new_admin.index');
        return redirect()->back()->with('success', 'Data successfully Submitted');
        // }catch (\Exception $e)
        // {
        //     alert()->error('Something Went Wrong!', 'Attention!')->persistent('Close');
        //     return redirect()->back();
        // }

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
        return view('admin.bank.company_list', compact('comp'));

    }

}
