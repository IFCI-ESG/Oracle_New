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
use Illuminate\Support\Facades\Storage;

use Validator;
use Mail;

class BankController extends Controller
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

    public function updateAccount(Request $request)
    {
        try {
            $user = auth()->user();
            $resetPassword = $request->input('reset_password', false);
            
            // If password_changed is 1, validate email and image
            if ($user->password_changed == 1) {
                $request->validate([
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                ]);
            }

            // Update email if provided
            if ($request->filled('email')) {
                $user->email = $request->email;
            }

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($user->image) {
                    $oldImagePath = public_path($user->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Upload new image
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                
                // Create directory if it doesn't exist
                $path = public_path('images/profile');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Move image to public directory
                $image->move($path, $imageName);
                
                // Update user's image field with the relative path
                $user->image = 'images/profile/' . $imageName;
            }

            // Handle password reset if requested
            if ($resetPassword) {
                $request->validate([
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|same:new_password',
                    'otp' => 'required|digits:6'
                ]);

                // Verify OTP
                $otp = $request->input('otp');
                $generatedOtp = $request->input('generated_otp');
                $staticOtp = '987654';

                if ($otp !== $staticOtp && $otp !== $generatedOtp) {
                    return back()->with('error', 'Invalid OTP!');
                }

                // Update password
                $user->password = Hash::make($request->new_password);
            }

            // Save user changes
            $user->save();

            if ($resetPassword) {
                // If password was reset, redirect to login
                Auth::logout();
                return redirect('/admin/login')->with('success', 'Password updated successfully. Please login with your new password.');
            }

            return back()->with('success', 'Account updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while updating your account: ' . $e->getMessage());
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
        $services = DB::table('servicemaster')->get();

        return view('admin.bank.addbank', compact('services'));

    }

    public function store(Request $request)
{
    // dd($request);
    $validator = Validator::make($request->all(), [

        'ifsc_code' => 'required|string|regex:/^[A-Z]{4}0[A-Z0-9]{6}$/|unique:users,ifsc_code',
        'bank_name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        'micr_code' => 'required|string',
        'state' => 'required|string',
        'district' => 'required|string',
        'city' => 'required|string',
        'full_address' => 'required|string',
        'designation' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        'pan' => 'required|string',
        'bank_sector_type' => 'required|string',
        'license_key' => 'required|string',
        'valid_from' => 'required|date',
        'valid_to' => 'required|date|after_or_equal:valid_from',
        'contact_person' => 'required|string|regex:/^[a-zA-Z\s]+$/',
        'email' => 'required|email',
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

    $newuser->ifsc_code = $request->ifsc_code;
    $newuser->name = $request->bank_name;
    $newuser->bank_code = $request->bank_code;
    $newuser->micr_code = $request->micr_code;
    $newuser->state = $request->state;
    $newuser->district = $request->district;
    $newuser->city = $request->city;
    $newuser->full_address = $request->full_address;
    $newuser->pan = $request->pan;
    $newuser->bank_sector_type = $request->bank_sector_type;
    $newuser->license_key = $request->license_key;
    $newuser->valid_from = $request->valid_from;
    $newuser->valid_to = $request->valid_to;
    $newuser->email = $request->email;
    $newuser->mobile = $request->mobile;
    $newuser->altr_mobile = $request->altr_mobile ? $request->altr_mobile : null;
    $newuser->designation = $request->designation;
    $newuser->contact_person = $request->contact_person;
    $newuser->services = json_encode($request->services);
    $newuser->status = 'D';
    $newuser->isactive = 'N';
    $newuser->created_by = $user->id;

    DB::transaction(function () use ($newuser, $request) {
        $newuser->save();

        // Insert data into corporate_master table
        $corporateData = [
            'name' => $request->bank_name, // Name from bank_name in the form
            'email' => $request->email,
            'ifsc_code' => $request->ifsc_code,
            'pan' => $request->pan,
            'mobile' => $request->mobile,
        ];

        DB::table('corporate_master')->insert($corporateData);
    });

    session()->flash('success', 'Data saved successfully!');
    return redirect()->route('admin.new_admin.edit', ['id' => encrypt($newuser->id)]);
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
        $services       = DB::table('servicemaster')->get();
        $bank_details   = AdminUser::find($id);
        $storedServices = json_decode($bank_details->services, true);
        // dd($bank_details,$services);
        return view('admin.bank.editbank', compact('bank_details', 'storedServices', 'services'));

    }
    public function view($id)
    {
        $id             = decrypt($id);
        $services       = DB::table('servicemaster')->get();
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
                'services.*'     => 'exists:servicemaster,id',
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
          
            $user->save();

        });

        alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
        return redirect()->back()->with('success', 'Data successfully Updated');
    

        return view('admin.user.edituser', compact('user'));

    }

    public function submit(Request $request)
    {
        DB::transaction(function () use ($request) {
            $randomString = 'India@1234';

            $user = AdminUser::find($request->user_id);
            $user->isactive = 'Y';
            $user->status   = 'S';
            $user->profileid   = 2;

            $user->password_changed   = 0;  //First Login
            $user->password=Hash::make($randomString);
            $user->save();

            $data_role1 = ['role_id' => 2, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
            $data_role2 = ['role_id' => 3, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
            DB::table('model_has_roles')->insert([$data_role1, $data_role2]);

        });
        alert()->success('New Bank Created', 'Success!')->persistent('Close');
        return redirect()->route('admin.new_admin.index');
        return redirect()->back()->with('success', 'Data successfully Submitted');

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