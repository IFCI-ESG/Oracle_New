<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicUser;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use DB;

class SignupController extends Controller
{
   
    public function showSignupForm()
    {
        return view('signup');
    }

    public function submitSignupForm(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|regex:/^[A-Za-z\s]+$/',
        'organization' => 'required|regex:/^[A-Za-z\s]+$/',
        'email' => 'required|email|unique:public_users,email',
        'mobile' => 'required|regex:/^\d{10}$/|unique:public_users,mobile',
        'pan' => 'required|regex:/^[A-Z0-9]{10}$/|unique:public_users,pan',
        'designation' => 'required|regex:/^[A-Za-z\s]+$/',
        'cin' => 'required|regex:/^[A-Za-z0-9]+$/',
        'address' => 'required|string',
 
     ], [
        'email.unique' => 'Email Address is already registered.',
        'mobile.unique' => 'Mobile Number is already registered.',
        'pan.unique' => 'PAN Number is already registered.',
    ]);

      if ($validator->fails()) {
         return redirect()->route('signup')
                         ->withErrors($validator)
                         ->withInput();
      }

      try {
        $profileUser = new PublicUser();
        $profileUser->name = $request->name;
        $profileUser->organization = $request->organization;
        $profileUser->email = $request->email;
        $profileUser->mobile = $request->mobile;
        $profileUser->pan = $request->pan;
        $profileUser->designation = $request->designation;
        $profileUser->cin = $request->cin;
        $profileUser->address = $request->address;
        $profileUser->remarks = $request->remarks;

        $profileUser->save();
        return redirect()->route('signup')
                         ->with('success', 'Registration Successful!');
    } catch (\Exception $e) {
        Log::error('Signup Error: ' . $e->getMessage());
        return redirect()->route('signup')
                         ->withErrors(['error' => 'Something went wrong. Please try again.'])
                         ->withInput();
    }
  }

}
 