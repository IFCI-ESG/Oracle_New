<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\BankDetails;
use App\Models\User;
use App\Models\AdminUser;
use DB;
use Auth;
use Carbon\Carbon;
use Mail;
use Hash;
use App\Models\TargetSegment;
use App\Models\ApplicantCinPan;
use App\Mail\NewRegistration;
use Log;
use Exception;
// use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;


class BankBranchController extends Controller
{
    // Index method to list all branches
    public function index()
    {
        $user = Auth::user();
        $branch_details = DB::table('users')
                            ->where('created_by', $user->id)
                            ->orderby('id')->get();

        return view('admin.bank_branch.index', compact('branch_details'));
    }

    // Create method for bulk upload
     public function create()
    {
        $branchDetails = DB::table('users_temp')
          ->select('users_temp.*')
          ->where('users_temp.created_by', '=', Auth::user()->id)
          ->where(function ($query) {
            $query->where('users_temp.status', '=', '')
                  ->orWhereNull('users_temp.status')
                  ->orWhere('users_temp.status', '!=', 'S');
         })
          ->get();

          $duplicatemobileCount = DB::table('users_temp')
            ->select('mobile')
            ->groupBy('mobile')
            ->havingRaw('count(mobile) > 1')
            ->count();

          $duplicateIfscCount = DB::table('users_temp')
            ->select('ifsc_code')
            ->groupBy('ifsc_code')
            ->havingRaw('count(ifsc_code) > 1')
            ->count();

          return view('admin.bank_branch.create_bulk',  compact('branchDetails','duplicatemobileCount','duplicateIfscCount'));
    }

    // Added by Owais
    public function deleteAllBranchRecords() {
        $userId = Auth::user()->id;
        try {
          DB::table('users_temp')
           ->where('created_by', $userId)
           ->delete();
          return response()->json(['success' => true, 'message' => 'All records deleted successfully']);
        } catch (\Exception $e) {
          return response()->json(['success' => false, 'message' => 'Error deleting records: ' . $e->getMessage()]);
        }

    }

    public function deleteBranchTempRow($id) {

        $row = DB::table('users_temp')->where('id', $id)->first();
        if ($row) {
          DB::table('users_temp')->where('id', $id)->delete();
          return response()->json(true);
         }
        return response()->json(false);
    }

     public function updateBranch(Request $request) {

        $request->validate([
            'id' => 'required|exists:users_temp,id',
            'name' => 'required',
            'email' => 'required',
            'ifsc_code' => 'required',
            'pincode' => 'required',
            'contact_person' => 'required',
            'designation' => 'required',
            'mobile' => 'required',
        ]);

        $existingMobile = DB::table('users_temp')
            ->where('mobile', $request->mobile)
            ->where('id', '!=', $request->id)
            ->exists();

        if ($existingMobile) {
            return response()->json(['success' => false, 'message' => 'Mobile number already exists']);
        }


         $existingIfsc = DB::table('users_temp')
            ->where('ifsc_code', $request->ifsc_code)
            ->where('id', '!=', $request->id)
            ->exists();

        if ($existingIfsc) {
            return response()->json(['success' => false, 'message' => 'IFSC Code already exists']);
        }

        $ifscCode = $request->ifsc_code;
        $userBankCode = Auth::user()->bank_code;
        $response = Http::get("https://ifsc.razorpay.com/{$ifscCode}");
        $data = $response->json();

        if ($response->failed()) {
            return response()->json(['success' => false, 'message' => 'IFSC Code already exists']);
        }

        if (isset($data['BANKCODE']) && $data['BANKCODE'] !== $userBankCode) {
            return response()->json(['success' => false, 'message' => 'IFSC Code Does not belong to your Bank! Please use Valid IFSC Code']);
        }

        $updated = DB::table('users_temp')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'ifsc_code' => $request->ifsc_code,
                'pincode' => $request->pincode,
                'contact_person' => $request->contact_person,
                'designation' =>$request->designation,
                'mobile' => $request->mobile,


            ]);

        if ($updated) {
            return response()->json(['success' => true, 'message' => 'Record updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update record']);
        }
    }

    public function FinalSubmitBranchRecords(Request $request) {
        $userId =  Auth::user()->id;
        try {
           DB::table('users_temp')
              ->where('created_by', $userId)
              ->update(['status' => 'S']);
           return response()->json(['success' => true, 'message' => 'All records updated Successfully!']);
       } catch (\Exception $e) {
           return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
       }
    }

    // Add method for adding a single branch
    public function add()
    {
        return view('admin.bank_branch.addbranch');
    }

    // Method to store CSV data
    // public function bulk_store(Request $request)
    // {
    // //    dd($request);

    //     $userInput = $request->all();
    //     $rules = [
    //         'file' => 'required|file|mimes:csv,txt|max:20480'
    //     ];

    //     $validator = Validator::make($request->only('file'), $rules);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $file = $request->file('file');
    //     $name = time().'-'.$file->getClientOriginalName();
    //     // try {

    //         $arraydata=$this->csvToArray($file);
    //         $keyarray=array();
    //     //    dd($arraydata);
    //         $i=1;
    //        foreach ($arraydata as $key => $value) {
    //         $i=$i+1;
    //         if ((!isset($value['BranchName'])) ||  (!isset($value['Email'])) ||  (!isset($value['ContactPerson']))||  (!isset($value['Designation']))||  (!isset($value['Mobile']))||  (!isset($value['IfscCode']))||  (!isset($value['PinCode'])) ) {
    //             $validator->errors()->add('customError', 'The column names "BranchName","Email","ContactPerson","Designation","Mobile","IfscCode"and "PinCode" should appear in the first row of the CSV.');
    //             return redirect()->back()->withErrors($validator);
    //         }
    //         if (empty(trim($value['BranchName']))) {
    //             $validator->errors()->add('customError', 'Column "BranchName" cannot be null. Please check  row no:- '.$i);
    //             return redirect()->back()->withErrors($validator);
    //         }
    //         if (empty(trim($value['Email'])) || !filter_var($value['Email'], FILTER_VALIDATE_EMAIL)) {
    //                 $validator->errors()->add('customError',  "Invalid email or empty field. Please check  row no:- ".$i);
    //                             return redirect()->back()->withErrors($validator);
    //         }
    //         if (empty(trim($value['ContactPerson']))) {
    //             $validator->errors()->add('customError', 'Column "ContactPerson" cannot be null. Please check  row no:- '.$i);
    //             return redirect()->back()->withErrors($validator);
    //        }
    //         if (empty(trim($value['Designation']))) {
    //             $validator->errors()->add('customError', 'Column "Designation" cannot be null. Please check  row no:- '.$i);
    //             return redirect()->back()->withErrors($validator);
    //        }
    //         $pattern = "/^[6789]\d{9}$/";

    //         // Check if the mobile number is empty or invalid
    //             if (empty($value['Mobile']) || !preg_match($pattern, $value['Mobile'])) {

    //              $validator->errors()->add('customError', 'Invalid Mobile No or empty field!.Please check  row no:- '.$i );
    //                         return redirect()->back()->withErrors($validator);
    //         }
    //        if (empty($value['IfscCode'])) {
    //          $validator->errors()->add('customError', 'Column "IfscCode" cannot be null!. Please check  row no:- '.$i);
    //             return redirect()->back()->withErrors($validator);
    //         }

    //         if (empty($value['PinCode']) || !preg_match("/^\d{5}|\d{6}$/", $value['PinCode'])) {
    //             $validator->errors()->add('customError', 'Invalid PinCode or empty field! . Please check  row no:- '.$i);
    //             return redirect()->back()->withErrors($validator);
    //         }

    //         DB::table('users_temp')->insert([
    //                     'name' => trim($value['BranchName']),
    //                     'email' =>trim($value['Email']),
    //                     'contact_person' =>trim( $value['ContactPerson']),
    //                     'designation' => trim($value['Designation']),
    //                     'mobile' =>trim($value['Mobile']),
    //                     'ifsc_code' => trim($value['IfscCode']),
    //                     'pincode' => trim($value['PinCode']),
    //                     'created_by'      => Auth::user()->id,
    //                     'created_at'      => carbon::now(),
    //                     'updated_at'      => carbon::now(),
    //                     ]);

    //     }

    //         return redirect()->back()->with('success', 'Your Excel file has been uploaded successfully! Please Verify the Branch Data before Final Submission. (Note: Pink Colour indicates duplicate entries.)');
    //     // } catch (Exception $e) {
    //     //         $validator->errors()->add('customError',"Something went wrong. Please try again after some time");
    //     //         return redirect()->back()->withErrors($validator);
    //     // }

    // }

    public function bulk_store(Request $request)
    {
        $userInput = $request->all();
        $rules = [
            'file' => 'required|file|mimes:csv,txt|max:20480'
        ];

        $validator = Validator::make($request->only('file'), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $file = $request->file('file');
        $name = time().'-'.$file->getClientOriginalName();
        
        try {
            $arraydata = $this->csvToArray($file);
            $keyarray = array();
            $i = 1;
            
            foreach ($arraydata as $key => $value) {
                $i = $i + 1;
                
                // Basic validation for required columns
                if ((!isset($value['Email'])) || (!isset($value['ContactPerson'])) || (!isset($value['Designation'])) || 
                    (!isset($value['Mobile'])) || (!isset($value['IfscCode'])) || (!isset($value['PinCode']))) {
                    $validator->errors()->add('customError', 'Required columns are missing in CSV.');
                    return redirect()->back()->withErrors($validator);
                }

                // Validate IFSC Code format and fetch branch details
                $ifscCode = trim($value['IfscCode']);
                $response = Http::get("https://ifsc.razorpay.com/{$ifscCode}");
                
                if ($response->failed()) {
                    $validator->errors()->add('customError', 'Invalid IFSC Code or not found. Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                $branchData = $response->json();
                $userBankCode = Auth::user()->bank_code;

                // Verify bank code matches
                if (isset($branchData['BANKCODE']) && $branchData['BANKCODE'] !== $userBankCode) {
                    $validator->errors()->add('customError', 'IFSC Code does not belong to your bank. Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                // Get branch name from API response
                $branchName = $branchData['BRANCH'] ?? 'NA';

                // Mobile validation
                $pattern = "/^[6789]\d{9}$/";
                if (empty($value['Mobile']) || !preg_match($pattern, $value['Mobile'])) {
                    $validator->errors()->add('customError', 'Invalid Mobile No or empty field!.Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                // Insert into database with branch name
                DB::table('users_temp')->insert([
                    'name' => $branchName,
                    'email' => trim($value['Email']),
                    'contact_person' => trim($value['ContactPerson']),
                    'designation' => trim($value['Designation']),
                    'mobile' => trim($value['Mobile']),
                    'ifsc_code' => $ifscCode,
                    'pincode' => trim($value['PinCode']),
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            return redirect()->back()->with('success', 'Your Excel file has been uploaded successfully! Please Verify the Branch Data before Final Submission.');
        } catch (\Exception $e) {
            \Log::error("Bulk upload error: " . $e->getMessage());
            $validator->errors()->add('customError', "Something went wrong. Please try again after some time");
            return redirect()->back()->withErrors($validator);
        }
    }



    // method to store single branch
    public function store(Request $request)
    {
            // dd('d');
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'branch_name' => 'required|string',
            'micr_code'            => 'required|string',
            'full_address'            => 'required|string',
            'state'            => 'required|string',
            'district'            => 'required|string',
            'email' => 'required|email',
            'contact_person' => 'required|string',
            'designation' => 'nullable|string',
            'mobile' => 'required|digits:10',
           'ifsc_code' => 'required|string|max:11|unique:users,ifsc_code',
            'pincode' => 'required|digits:6',
        ]);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userInput = $request->all();

        array_walk_recursive($userInput, function (&$userInput) {
            $userInput = strip_tags($userInput);
        });
        $request->merge($userInput);

        // try {

        $emailExists = AdminUser::where('email', $request->email)->orwhere('mobile', $request->mobile)->exists();

        if ($emailExists) {
            // dd($emailExists,$mobileExists);
            // alert()->error('Email, Mobile should be unique! These are already Registered', 'Attention!')->persistent('Close');
            // return redirect()->back();

            return redirect()->back()->withErrors(['message' => 'Email, Mobile should be unique! These are already Registered'])->withInput();
        }
    // try{

        // Save data to the database
        $branch = new AdminUser;
            $branch->name = $request->branch_name;
            $branch->micr_code        = $request->micr_code;
            $branch->state        = $request->state;
            $branch->district        = $request->district;
            $branch->full_address        = $request->full_address;
            $branch->email = $request->email;
            $branch->contact_person = $request->contact_person;
            $branch->designation = $request->designation;
            $branch->mobile = $request->mobile;
            $branch->ifsc_code = $request->ifsc_code;
            $branch->pincode = $request->pincode;
            $branch->status = 'D';
            $branch->isactive = 'N';
            $branch->created_by = Auth::user()->id;

        DB::transaction(function () use ($branch) {
            $branch->save();
        });

        session()->flash('success', 'Data saved successfully!');
        return redirect()->route('admin.bank_branch.edit', ['id' => encrypt($branch->id)]);
        // return redirect()->route('admin.bank_branch_bulk.index')->with('success', 'Branch saved successfully');
        // } catch (\Exception $e) {
        //     alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     // errorMail($e, $request->id, Auth::user()->id);
        //     return redirect()->back();
        // }
    }

    public function edit($id)
    {
        $id             = decrypt($id);
        $bank_details   = AdminUser::find($id);
        // dd($bank_details);
        return view('admin.bank_branch.editbranch', compact('bank_details'));

    }

    public function view($id)
    {
        $id             = decrypt($id);
        $bank_details   = AdminUser::find($id);
        // dd($bank_details);
        return view('admin.bank_branch.viewbranch', compact('bank_details'));
    }

    public function getPincodeDetails(Request $request) {

        $pincode = $request->input('pincode');
        $stateDistrict_details = DB::table('pincodes')
          ->where('pincode', $pincode)
          ->first();

          if ($stateDistrict_details) {
            return response()->json([
              'state' => $stateDistrict_details->state,
              'district' => $stateDistrict_details->city,
            ]);
         } else {
          return response()->json(['error' => 'State/District details not found.'], 404);
         }
      }

    public function update(Request $request)
    {
        $user = Auth::user();

        // try{
            $validator = Validator::make($request->all(), [
                'branch_name' => 'required|string',
                'micr_code'            => 'required|string',
            'full_address'            => 'required|string',
            'state'            => 'required|string',
            'district'            => 'required|string',
                'email' => 'required|email',
                'contact_person' => 'required|string',
                'designation' => 'nullable|string',
                'mobile' => 'required|digits:10',
                'ifsc_code' => 'required|string|max:11',
                'pincode' => 'required|digits:6',
            ]);



        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($request) {
            $branch = AdminUser::find($request->user_id);
                $branch->name = $request->branch_name;
                $branch->micr_code        = $request->micr_code;
                $branch->state        = $request->state;
                $branch->district        = $request->district;
                $branch->full_address        = $request->full_address;
                $branch->email = $request->email;
                $branch->contact_person = $request->contact_person;
                $branch->designation = $request->designation;
                $branch->mobile = $request->mobile;
                $branch->ifsc_code = $request->ifsc_code;
                $branch->pincode = $request->pincode;
              
            $branch->save();

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

    public function submit(Request $request)
{
    $loggedInUserEmail = Auth::user()->email;
    $corporate = DB::table('corporate_master')->where('email', $loggedInUserEmail)->first();
    if (!$corporate) {
        alert()->error('Corporate does not exist!')->persistent('Close');
        return redirect()->route('admin.bank_branch.index');
    }
    DB::transaction(function () use ($request, $corporate) {

        $user = AdminUser::find($request->user_id);
        $user->isactive = 'Y';
        $user->status = 'S';
        $user->profileid = 3;
        $user->password_changed = 0;  // First login
        $user->password = Hash::make('India@1234');
        $user->corporateid = $corporate->id;
        $user->save();
        $data_role2 = ['role_id' => 3, 'model_type' => 'App\Models\AdminUser', 'model_id' => $user->id];
        DB::table('model_has_roles')->insert([$data_role2]);
    });


    alert()->success('New Branch Created', 'Success!')->persistent('Close');
    return redirect()->route('admin.bank_branch.index');
}


    // Additional helper function to validate each row of data
    private function validateRowData($value, $i, $validator)
    {
        if (empty(trim($value['BankName']))) {
            $validator->errors()->add('customError', 'Column "BankName" cannot be null. Please check row no: ' . $i);
            return redirect()->back()->withErrors($validator);
        }

        if (empty(trim($value['Email'])) || !filter_var($value['Email'], FILTER_VALIDATE_EMAIL)) {
            $validator->errors()->add('customError', 'Invalid or empty Email. Please check row no: ' . $i);
            return redirect()->back()->withErrors($validator);
        }

        if (empty(trim($value['ContactPerson']))) {
            $validator->errors()->add('customError', 'Column "ContactPerson" cannot be null. Please check row no: ' . $i);
            return redirect()->back()->withErrors($validator);
        }

        if (empty(trim($value['Designation']))) {
            $validator->errors()->add('customError', 'Column "Designation" cannot be null. Please check row no: ' . $i);
            return redirect()->back()->withErrors($validator);
        }

        // Mobile validation pattern for 10-digit mobile number starting with 6-9
        $pattern = "/^[6789]\d{9}$/";
        if (empty($value['Mobile']) || !preg_match($pattern, $value['Mobile'])) {
            $validator->errors()->add('customError', 'Invalid Mobile No or empty field. Please check row no: ' . $i);
            return redirect()->back()->withErrors($validator);
        }

        if (empty($value['IfscCode'])) {
            $validator->errors()->add('customError', 'Column "IfscCode" cannot be null. Please check row no: ' . $i);
            return redirect()->back()->withErrors($validator);
        }

        // PinCode validation
        if (empty($value['PinCode']) || !preg_match("/^\d{5}|\d{6}$/", $value['PinCode'])) {
            $validator->errors()->add('customError', 'Invalid PinCode or empty field. Please check row no: ' . $i);
            return redirect()->back()->withErrors($validator);
        }
    }

    // Method to convert CSV file to array
    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    // Method for transferring records from temp table to final table
    public function FinalInsert_old()
    {
        try {

            $bank_create_limit = config('constants.bank_create_limit');
            if (empty($bank_create_limit)) {
                throw new \Exception('Bank create limit is not set in the configuration');
            }

            // Fetch records from the temporary table
            $records = DB::table('users_temp')
                ->where('status', 'S')
                ->orderBy('id', 'ASC')
                ->take($bank_create_limit)
                ->get();

                // dd($records);

            // Check if no records were found
            if ($records->isEmpty()) {
                Log::info('No records found in users_temp table.');
                return 'No records to process.';
            }

            foreach ($records as $key => $value) {
                $value = (array) $value; // Convert object to array
                // dd($value);
                try {
                    // Start the transaction
                    DB::beginTransaction();

                     $randomString = $this->generateRandomString(5);

                    // Insert into the final table
                    $insertedId = DB::table('users')->insertGetId([
                        'name'     => trim($value['name']),
                        'email'        => trim($value['email']),
                        'password' => '$2y$10$vTj1GhEjFcL0duMu1AqmGebo48zWZoxIuG8ThKXNfEDw7ltrUobTC',    // India@1234
                        // 'password' => Hash::make($randomString),    // dynamic password generation
                        'contact_person'=> trim($value['contact_person']),
                        'designation'  => trim($value['designation']),
                        'mobile'       => trim($value['mobile']),
                        'ifsc_code'     => trim($value['ifsc_code']),
                        'pincode'      => trim($value['pincode']), // Use pincode1 here
                        'created_by'      => trim($value['created_by']),
                        'created_at'      => carbon::now(),
                        'updated_at'      => carbon::now(),
                        'status'      => 'S',
                        'isactive'      => 'Y',
                    ]);

                        // dd($insertedId);

                    $data_role = array('role_id' => 3, 'model_type' => 'App\Models\AdminUser', 'model_id' => $insertedId);
                    DB::table('model_has_roles')->insert($data_role);

                    $branch = DB::table('users')->where('id', $insertedId)->first();
                    $bank = DB::table('users')->where('id', $branch->created_by)->first();
                        // dd($branch,$bank);

                    // $data = array('name'=>$branch->name, 'unique_id'=>$branch->email, 'password'=>$randomString, 'bank_name'=>$bank->name);

                    // Mail::send('emails.email_credentials', $data, function($message) use($data) {
                    // $message->to($data ['unique_id'],$data ['name'])->subject
                    //     ('Account Created | ESG - Prakrit ');
                    //         // $message->cc('pliwg@ifciltd.com');
                    //         // $message->bcc('shivam.shukla@ifciltd.com');
                    // });

                    // Delete the record from the temp table after processing
                    DB::table('users_temp')->where('id', $value['id'])->delete();

                    // Commit the transaction
                    DB::commit();

                } catch (\Exception $e) {
                    // Rollback in case of error and log the error
                    DB::rollBack();

                    // Delete the record from the temp table after processing
                    DB::table('users_temp')->where('id', $value['id'])->delete();

                    DB::table('users_junk')->insert([
                        'name'     => trim($value['name']),
                        'email'        => trim($value['email']),
                        'contact_person'=> trim($value['contact_person']),
                        'designation'  => trim($value['designation']),
                        'mobile'       => trim($value['mobile']),
                        'ifsc_code'     => trim($value['ifsc_code']),
                        'pincode'      => trim($value['pincode']), // Use pincode here
                        'created_by'      => trim($value['created_by']),
                        'created_at'      => carbon::now(),
                        'updated_at'      => carbon::now(),
                    ]);

                    Log::error("Error processing record ID: " . $value['id'] . " - " . $e->getMessage());
                }
            }

            // Log success after processing all records
            Log::info('Successfully processed and inserted records from users_temp.');

            return 'Process completed successfully.';

        } catch (\Exception $e) {
            // Log general errors (e.g., configuration issues)
            Log::error('Error during FinalInsert process: ' . $e->getMessage());

            return 'Error during the insert process: ' . $e->getMessage();
        }
    }

    public function FinalInsert()
{
    try {
        $bank_create_limit = config('constants.bank_create_limit');
        if (empty($bank_create_limit)) {
            throw new \Exception('Bank create limit is not set in the configuration');
        }


        $records = DB::table('users_temp')
            ->where('status', 'S')
            ->orderBy('id', 'ASC')
            ->take($bank_create_limit)
            ->get();


        if ($records->isEmpty()) {
            Log::info('No records found in users_temp table.');
            return 'No records to process.';
        }

        foreach ($records as $key => $value) {
            $value = (array) $value;

            try {

                DB::beginTransaction();

                $randomString = 'India@1234';
                $ifscCode = $value['ifsc_code'];
                $response = Http::get("https://ifsc.razorpay.com/{$ifscCode}");

                $pincodeDetails = DB::table('pincodes')->where('pincode', $value['pincode'])->first(['state', 'city']);

                if ($pincodeDetails) {
                  $state = $pincodeDetails->state;
                  $city = $pincodeDetails->city;
                } else {
                  $state = null;
                  $city = null;
                }

                if ($response->failed()) {
                    throw new \Exception('Invalid IFSC Code or not found.');
                }

                $data = $response->json();


                if (!isset($data['BANK']) || !isset($data['STATE'])) {
                    throw new \Exception('Incomplete data from Razorpay API for IFSC Code: ' . $ifscCode);
                }


                $password= Hash::make($randomString);

               $insertedId = DB::table('users')->insertGetId([
                    'name'          => trim($data['BRANCH']),
                    'email'         => trim($value['email']),
                    'password'      =>  $password,
                    'contact_person'=> trim($value['contact_person']),
                    'designation'   => trim($value['designation']),
                    'mobile'        => trim($value['mobile']),
                    'ifsc_code'     => trim($value['ifsc_code']),
                    'pincode'       => trim($value['pincode']),
                    'created_by'    => trim($value['created_by']),
                    'created_at'    => carbon::now(),
                    'updated_at'    => carbon::now(),
                    'status'        => 'S',
                    'isactive'      => 'Y',
                    'state'         => $state,
                    'city'          => $city,
                    'district'      => $city,
                    'full_address'  => trim($data['ADDRESS']),
                    'micr_code'     => trim($data['MICR']),
                    'password_changed' => 0,

                ]);

                // Assign role to the newly created user
                $data_role = array('role_id' => 3, 'model_type' => 'App\Models\AdminUser', 'model_id' => $insertedId);
                DB::table('model_has_roles')->insert($data_role);

                // Delete the record from the temp table after processing
                DB::table('users_temp')->where('id', $value['id'])->delete();

                // Commit the transaction
                DB::commit();

            } catch (\Exception $e) {
                // Rollback in case of error and log the error
                DB::rollBack();

                // Delete the record from the temp table after processing
                DB::table('users_temp')->where('id', $value['id'])->delete();

                // Insert the failed record into junk table
                DB::table('users_junk')->insert([
                    'name'          => trim($value['name']),
                    'email'         => trim($value['email']),
                    'contact_person'=> trim($value['contact_person']),
                    'designation'   => trim($value['designation']),
                    'mobile'        => trim($value['mobile']),
                    'ifsc_code'     => trim($value['ifsc_code']),
                    'pincode'       => trim($value['pincode']),
                    'created_by'    => trim($value['created_by']),
                    'created_at'    => carbon::now(),
                    'updated_at'    => carbon::now(),
                ]);

                Log::error("Error processing record ID: " . $value['id'] . " - " . $e->getMessage());
            }
        }

        // Log success after processing all records
        Log::info('Successfully processed and inserted records from users_temp.');

        return 'Process completed successfully.';

    } catch (\Exception $e) {
        // Log general errors (e.g., configuration issues)
        Log::error('Error during FinalInsert process: ' . $e->getMessage());

        return 'Error during the insert process: ' . $e->getMessage();
    }
}

}

