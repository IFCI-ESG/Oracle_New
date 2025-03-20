<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\BankDetails;
use App\Models\User;
use DB;
use Auth;
use Carbon\Carbon;
use Mail;
use Hash;
use App\Models\TargetSegment;
use App\ApplicantCinPan;
use App\Mail\NewRegistration;
use Log;
use App\Models\BankFinancialDetails;
use Illuminate\Support\Facades\Storage;

class CompanyBulkUploadController extends Controller
{


    public function createBulkCompany(Request $request)

    {
        $userId = Auth::user()->id;

        if (Auth::user()->hasRole('Admin')) {
          $ifscCodes = DB::table('users')
           ->where('created_by', $userId)
           ->pluck('ifsc_code');
        } else if (Auth::user()->hasRole('SubAdmin')){
            $ifscCodes = DB::table('users')
            ->where('id', $userId)
            ->pluck('ifsc_code');
        }

        $sectors = DB::table('sector_master')
                ->select('id', 'name')
                ->get();

        $company_types = DB::table('comp_type_master')
                ->select('id', 'name')
                ->get();

        $class_types = DB::table('class_type_master')
                ->select('id', 'name')
                ->get();

         $totalCount = DB::table('users_details_temp')
                ->where('bank_id', $userId)
                ->where('status', '!=', 'S')
                ->count();

        $duplicatemobileCount = DB::table('users_details_temp')
                ->select('mobile')
                ->groupBy('mobile')
                ->havingRaw('count(mobile) > 1')
                ->count();

        $duplicatepanCount = DB::table('users_details_temp')
                ->select('pan')
                ->groupBy('pan')
                ->havingRaw('count(pan) > 1')
                ->count();

        if (Auth::user()->hasRole('Admin')) {
          $userDetails = DB::table('users_details_temp')
                ->select('users_details_temp.*', 'sector_master.id as sector_name', 'comp_type_master.id as company_type', 'class_type_master.id as class_type')
                ->join('sector_master', 'users_details_temp.sector_id', '=', 'sector_master.id')
                ->join('comp_type_master', 'users_details_temp.comp_type_id', '=', 'comp_type_master.id')
                ->join('class_type_master', 'users_details_temp.class_type_id', '=', 'class_type_master.id')
                ->where('users_details_temp.bank_id', '=', Auth::user()->id)
                ->where('users_details_temp.uploaded_by', '=', 'Bank')
                ->where(function ($query) {
                    $query->where('users_details_temp.status', '=', '')
                          ->orWhereNull('users_details_temp.status')
                          ->orWhere('users_details_temp.status', '!=', 'S');
                })
                ->get();
        } else if(Auth::user()->hasRole('SubAdmin')) {
            $userDetails = DB::table('users_details_temp')
             ->select('users_details_temp.*', 'sector_master.id as sector_name', 'comp_type_master.id as company_type', 'class_type_master.id as class_type')
             ->join('sector_master', 'users_details_temp.sector_id', '=', 'sector_master.id')
             ->join('comp_type_master', 'users_details_temp.comp_type_id', '=', 'comp_type_master.id')
             ->join('class_type_master', 'users_details_temp.class_type_id', '=', 'class_type_master.id')
             ->where('users_details_temp.created_by', '=', Auth::user()->id)
             ->where('users_details_temp.uploaded_by', '=','Branch')
             ->where(function ($query) {
                $query->where('users_details_temp.status', '=', '')
                      ->orWhereNull('users_details_temp.status')
                      ->orWhere('users_details_temp.status', '!=', 'S');
             })
            ->get();
        }

         return view('admin.user.bulk_company_user_create', compact('userDetails','ifscCodes','sectors','company_types','class_types','duplicatemobileCount','duplicatepanCount','totalCount'));
    }

    public function deleteCompanyTempRow($id) {

        $row = DB::table('users_details_temp')->where('id', $id)->first();
        if ($row) {
          DB::table('users_details_temp')->where('id', $id)->delete();
          return response()->json(true);
         }
        return response()->json(false);
    }

    public function deleteAllCompanyRecords(Request $request) {

       $userId = (string) Auth::user()->id;
       try {
         if (Auth::user()->hasRole('Admin')) {
            DB::table('users_details_temp')
             ->where('bank_id', $userId)
             ->where('uploaded_by', 'Bank')
             ->delete();
         } else if(Auth::user()->hasRole('SubAdmin')){
            DB::table('users_details_temp')
            ->where('created_by', $userId)
            ->where('uploaded_by', 'Branch')
            ->delete();
         }
         return response()->json(['success' => true, 'message' => 'All records deleted successfully']);
       } catch (\Exception $e) {
         return response()->json(['success' => false, 'message' => 'Error deleting records: ' . $e->getMessage()]);
      }
   }

   public function FinalSubmitCompanyRecords(Request $request) {
     $userId = (string) Auth::user()->id;
     try {
        if (Auth::user()->hasRole('Admin')) {
          DB::table('users_details_temp')
            ->where('bank_id', $userId)
            ->where('uploaded_by', 'Bank')
            ->update(['status' => 'S']);
        } else if(Auth::user()->hasRole('SubAdmin')) {
            DB::table('users_details_temp')
            ->where('created_by', $userId)
            ->where('uploaded_by', 'Branch')
            ->update(['status' => 'S']);
        }
        return response()->json(['success' => true, 'message' => 'All records updated successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
 }

 public function updateCompany(Request $request) {

    $request->validate([
        'id' => 'required|exists:users_details_temp,id',
        'ifsc_code' => 'required',
        'name' => 'required',
        'mobile' => 'required',
        'pan' => 'required',
        'contact_person' => 'required',
        'sector_id' => 'required',
        'zone' => 'required',
        'comp_type_id' => 'required',
        'class_type_id' => 'required',

    ]);

    $existingMobile = DB::table('users_details_temp')
        ->where('mobile', $request->mobile)
        ->where('id', '!=', $request->id)
        ->exists();

    if ($existingMobile) {
        return response()->json(['success' => false, 'message' => 'Mobile number already exists']);
    }


    $existingPan = DB::table('users_details_temp')
        ->where('pan', $request->pan)
        ->where('id', '!=', $request->id)
        ->exists();

    if ($existingPan) {
        return response()->json(['success' => false, 'message' => 'PAN already exists']);
    }


    $updated = DB::table('users_details_temp')
        ->where('id', $request->id)
        ->update([
            'ifsc_code' => $request->ifsc_code,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'pan' => $request->pan,
            'contact_person' => $request->contact_person,
             'sector_id' => $request->sector_id,
            'zone' => $request->zone,
            'comp_type_id' => $request->comp_type_id,
            'class_type_id' => $request->class_type_id


        ]);

    if ($updated) {
        return response()->json(['success' => true, 'message' => 'Record updated successfully']);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to update record']);
    }
}


public function deleteCorp($file)
    {
        $path = 'uploads/' . $file;
    Log::info("Attempting to delete file: $path");

    if (Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
        return response()->json(['message' => 'File deleted successfully']);
    }

    Log::error("File not found: $path");
    return response()->json(['error' => 'File not found'], 404);
    }


    public function storeCorp(Request $request)
    {

    //    dd($request->all(),$request->only('file'));
        $userInput = $request->all();

        $rules = [
            'file' => 'required|file|mimes:csv|max:20480'

        ];

        $validator = Validator::make($request->only('file'), $rules);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file = $request->file('file');

        // dd($file);

        $name = time().'-'.$file->getClientOriginalName();
        // try {
            $arraydata=$this->csvToArray($file);
            $keyarray=array();

            $i=1;
            foreach ($arraydata as $key => $value) {
                $i = $i + 1;

                if (Auth::user()->hasRole('Admin')) {
                   if ((!isset($value['Pan'])) ||  (!isset($value['ContactPerson'])) ||  (!isset($value['Designation'])) ||
                     (!isset($value['Mobile'])) ||  (!isset($value['BankZone'])) ||  (!isset($value['TypeAssetClass'])) ||
                     (!isset($value['CompanyType'])) ||  (!isset($value['Sector'])) ||  (!isset($value['fy_masters'])) ||
                     (!isset($value['BankExposure'])) ||  (!isset($value['IfscCode']))) {
                      $validator->errors()->add('customError', 'The column names "Pan","BankName","Email","ContactPerson","Designation","Mobile","BankZone" , "TypeAssetClass", " CompanyType", "Sector" ,"fy_masters", "BankExposure", "IfscCode" should appear in the first row of the CSV.');
                      return redirect()->back()->withErrors($validator);
                    }
                } else if (Auth::user()->hasRole('SubAdmin')) {
                    if ((!isset($value['Pan'])) ||  (!isset($value['ContactPerson'])) ||  (!isset($value['Designation'])) ||
                     (!isset($value['Mobile'])) ||  (!isset($value['BankZone'])) ||  (!isset($value['TypeAssetClass'])) ||
                     (!isset($value['CompanyType'])) ||  (!isset($value['Sector'])) ||  (!isset($value['fy_masters'])) ||
                     (!isset($value['BankExposure']))) {
                      $validator->errors()->add('customError', 'The column names "Pan","BankName","Email","ContactPerson","Designation","Mobile","BankZone" , "TypeAssetClass", " CompanyType", "Sector" ,"fy_masters", "BankExposure" should appear in the first row of the CSV.');
                      return redirect()->back()->withErrors($validator);
                    }
                }

                  // IfscCode validation - check if IFSC code is valid and belongs to the user's bank
                  if (Auth::user()->hasRole('Admin')) {
                  $ifscCodeExists = DB::table('users')
                  ->where('ifsc_code', '=', $value['IfscCode'])
                  ->where('created_by', '=', Auth()->user()->id)
                  ->exists();

                 if (!$ifscCodeExists) {
                   $validator->errors()->add('customError', 'Invalid IFSC or IFSC Code does not belong to your bank. Please check row no:- ' . $i);
                   return redirect()->back()->withErrors($validator);
                 }
                }

                // Validate if ContactPerson is empty
                if (empty(trim($value['ContactPerson']))) {
                    $validator->errors()->add('customError', 'Column "ContactPerson" cannot be null. Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                // Validate if Designation is empty
                if (empty(trim($value['Designation']))) {
                    $validator->errors()->add('customError', 'Column "Designation" cannot be null. Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                // Mobile validation - check if the mobile number is empty or invalid
                $pattern = "/^[6789]\d{9}$/";  // Mobile number pattern
                if (empty($value['Mobile']) || !preg_match($pattern, $value['Mobile'])) {
                    $validator->errors()->add('customError', 'Invalid Mobile No or empty field! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }



                // Pan validation - check if the PAN is empty or invalid
                if (empty($value['Pan']) || !preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $value['Pan'])) {
                    $validator->errors()->add('customError', 'Invalid Pan or empty field! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }


                // Validate other required fields
                if (empty($value['BankZone'])) {
                    $validator->errors()->add('customError', 'Column "BankZone" cannot be null! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                if (empty($value['TypeAssetClass'])) {
                    $validator->errors()->add('customError', 'Column "TypeAssetClass" cannot be null! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                if (empty($value['CompanyType'])) {
                    $validator->errors()->add('customError', 'Column "CompanyType" cannot be null! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                if (empty($value['Sector'])) {
                    $validator->errors()->add('customError', 'Column "Sector" cannot be null! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                if (empty($value['fy_masters'])) {
                    $validator->errors()->add('customError', 'Column "fy_masters" cannot be null! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }

                if (empty($value['BankExposure'])) {
                    $validator->errors()->add('customError', 'Column "BankExposure" cannot be null! Please check row no:- ' . $i);
                    return redirect()->back()->withErrors($validator);
                }
            }


        foreach ($arraydata as $key => $value) {

            if (Auth::user()->hasRole('Admin')) {
                  $branch = DB::table('users')
                                    ->where('ifsc_code', $value['IfscCode'])
                                    ->first();
                  DB::table('users_details_temp')->insert([
                        'name' => 'NA',
                        'contact_person' => trim($value['ContactPerson']),
                        'pan' =>trim( $value['Pan']),
                        'designation' => trim($value['Designation']),
                        'mobile' =>trim($value['Mobile']),
                        'zone' => trim($value['BankZone']),
                        'class_type_id' => trim($value['TypeAssetClass']),
                        'comp_type_id' => trim($value['CompanyType']),
                        'sector_id' => trim($value['Sector']),
                        'fy_id' => trim($value['fy_masters']),
                        'bank_exposure' => trim($value['BankExposure']),
                        'ifsc_code' => trim($value['IfscCode']),
                        'created_by' => $branch ? $branch->id : null ,
                        'bank_id' => Auth::user()->id ,
                        'borrower_type' => 'C',
                        'uploaded_by' => 'Bank'
                        ]);

                } else if (Auth::user()->hasRole('SubAdmin')) {
                     $branch_ifscCode = DB::table('users')
                      ->where('id', Auth()->user()->id)
                      ->value('ifsc_code');

                     DB::table('users_details_temp')->insert([
                          'name' => 'NA',
                          'contact_person' => trim($value['ContactPerson']),
                          'pan' =>trim( $value['Pan']),
                          'designation' => trim($value['Designation']),
                          'mobile' =>trim($value['Mobile']),
                          'zone' => trim($value['BankZone']),
                          'class_type_id' => trim($value['TypeAssetClass']),
                          'comp_type_id' => trim($value['CompanyType']),
                          'sector_id' => trim($value['Sector']),
                          'fy_id' => trim($value['fy_masters']),
                          'bank_exposure' => trim($value['BankExposure']),
                          'ifsc_code' => trim($branch_ifscCode),
                          'created_by' =>Auth::user()->id ,
                          'borrower_type' => 'C',
                          'uploaded_by' => 'Branch'
                          ]);
                  }

            }

            return redirect()->back()->with('success', 'Your Excel file has been uploaded successfully! Please Verify the Exposure Data before Final Submission. (Note: Pink Colour indicates duplicate entries.)');
        // } catch (Exception $e) {
        //         $validator->errors()->add('customError',"Something went wrong. Please try again after some time");
        //         return redirect()->back()->withErrors($validator);
        // }

    }



    public function storeRetail(Request $request)
    {

       // dd(DB::select('select * from bank_branch_details' ));
        $userInput = $request->all();
        $rules = [
            'files' => 'required|file|mimes:csv,txt|max:20480'
        ];

        $validator = Validator::make($request->only('files'), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file = $request->file('files');
        $name = time().'-'.$file->getClientOriginalName();
        try {

            $arraydata=$this->csvToArray($file);
            $keyarray=array();

            $i=1;
           foreach ($arraydata as $key => $value) {
            $i=$i+1;
            if ((!isset($value['Pan'])) ||  (!isset($value['CustomerName'])) ||  (!isset($value['ValueAsset']))||  (!isset($value['Email']))||  (!isset($value['Mobile']))||  (!isset($value['BankZone']))||  (!isset($value['TypeAssetClass'])) ||  (!isset($value['LoanTenure']))||  (!isset($value['fy_masters'])) ||  (!isset($value['BankExposure'])) ||  (!isset($value['Pincode'])) ||  (!isset($value['State'])) ||  (!isset($value['City']))||  (!isset($value['Address']))) {


                $validator->errors()->add('customError', 'The column names "Pan","BankName","Email","CustomerName","ValueAsset","Mobile","BankZone" , "TypeAssetClass", "LoanTenure" ,"fy_masters" and "BankExposure","Address","State","Pincode", "City" should appear in the first row of the CSV.');
                return redirect()->back()->withErrors($validator);
            }
            if (empty(trim($value['CustomerName']))) {
                $validator->errors()->add('customError', 'Column "CustomerName" cannot be null. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
            if (empty(trim($value['Email'])) || !filter_var($value['Email'], FILTER_VALIDATE_EMAIL)) {
                    $validator->errors()->add('customError',  "Invalid email or empty field. Please check  row no:- ".$i);
                                return redirect()->back()->withErrors($validator);
            }

            if (empty(trim($value['ValueAsset']))) {
                $validator->errors()->add('customError', 'Column "ValueAsset" cannot be null. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
           }
                $pattern = "/^[6789]\d{9}$/";

            // Check if the mobile number is empty or invalid
                if (empty($value['Mobile']) || !preg_match($pattern, $value['Mobile'])) {

                 $validator->errors()->add('customError', 'Invalid Mobile No or empty field!.Please check  row no:- '.$i );
                            return redirect()->back()->withErrors($validator);
            }
           if (empty($value['BankZone'])) {
             $validator->errors()->add('customError', 'Column "BankZone" cannot be null!. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }

            if (empty($value['Pan']) || !preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $value['Pan'])) {
                $validator->errors()->add('customError', 'Invalid Pan or empty field! . Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
               if (empty($value['TypeAssetClass'])) {
               $validator->errors()->add('customError', 'Column "TypeAssetClass" cannot be null!. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }

               if (empty($value['LoanTenure'])) {
             $validator->errors()->add('customError', 'Column "LoanTenure" cannot be null!. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
               if (empty($value['fy_masters'])) {
             $validator->errors()->add('customError', 'Column "fy_masters" cannot be null!. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
               if (empty($value['BankExposure'])) {
             $validator->errors()->add('customError', 'Column "BankExposure" cannot be null!. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
              if (empty(trim($value['Address']))) {
                $validator->errors()->add('customError', 'Column "Address" cannot be null. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
              if (empty(trim($value['Pincode']))) {
                $validator->errors()->add('customError', 'Column "Pincode" cannot be null. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
              if (empty(trim($value['State']))) {
                $validator->errors()->add('customError', 'Column "State" cannot be null. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }
              if (empty(trim($value['City']))) {
                $validator->errors()->add('customError', 'Column "City" cannot be null. Please check  row no:- '.$i);
                return redirect()->back()->withErrors($validator);
            }


        }

             foreach ($arraydata as $key => $value) {


                DB::table('users_details_temp')->insert([
                                'name' => trim($value['CustomerName']),
                                'contact_person' => trim($value['CustomerName']),
                                'email' =>trim($value['Email']),
                                'pan' =>trim( $value['Pan']),
                                'mobile' =>trim($value['Mobile']),
                                'zone' => trim($value['BankZone']),
                                'class_type_id' => trim($value['TypeAssetClass']),
                                'fy_id' => trim($value['fy_masters']),
                                'bank_exposure' => trim($value['BankExposure']),
                                'value_asset' => trim($value['ValueAsset']),
                                'loan_tenure' => trim($value['LoanTenure']),
                                'reg_off_add' => trim($value['Address']),
                                'reg_off_pin' => trim($value['Pincode']),
                                'reg_off_state' => trim($value['State']),
                                'reg_off_city' => trim($value['City']),
                                'created_by' => Auth::user()->id ,
                                'bank_id' => Auth::user()->id ,
                                'borrower_type' => 'R'
                        ]);


            }

            return redirect()->back()->with('success', 'Your Excel file was uploaded successfully!');
        } catch (Exception $e) {
                $validator->errors()->add('customError',"Something went wrong. Please try again after some time");
                return redirect()->back()->withErrors($validator);
        }

    }

    public function FinalInsertCorp() {
        try {
            $brrower_create_limit = config('constants.brrower_create_limit');

            if (empty($brrower_create_limit)) {
                throw new \Exception('Brrower create limit is not set in the configuration');
            }

            $records = DB::table('users_details_temp')
                ->where('borrower_type', 'C')
                ->where('status', 'S')
                ->orderBy('id', 'ASC')
                ->take($brrower_create_limit)
                ->get();


            if ($records->isEmpty()) {
                Log::info('No records found in users_details_temp table.');
                return 'No records to process.';
            }

            foreach ($records as $key => $value) {
                try {
                    // API Call for Company Details
                    $url = 'https://api.probe42.in/probe_pro_sandbox/companies/' . $value->pan . '/comprehensive-details?identifier_type=PAN';
                    $api_key = '07wvsOWBoq9iwpjhMm2C22eKOymlpqht9WmtYEFb';

                    $headers = [
                        'Accept: application/json',
                        'x-api-key: ' . $api_key,
                        'x-api-version: 1.3'
                    ];

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    if (curl_errno($ch)) {
                        throw new \Exception('cURL Error: ' . curl_error($ch));
                    }

                    $companyData = json_decode($response, true);

                    $companyName = $companyData['data']['company']['legal_name'] ?? 'Unknown Company';
                    $companyEmail = $companyData['data']['company']['email'] ?? 'Unknown';
                    $companyCin = $companyData['data']['company']['cin'] ?? '';
                    $companyAddress = $companyData['data']['company']['registered_address']['full_address'] ?? '';
                    $companyPin = $companyData['data']['company']['registered_address']['pincode'] ?? '';
                    $companyState = $companyData['data']['company']['registered_address']['state'] ?? '';
                    $companyCity= $companyData['data']['company']['registered_address']['city'] ?? '';
                    $addressLines = [
                        $companyData['data']['company']['business_address']['address_line1'] ?? '',
                        $companyData['data']['company']['business_address']['address_line2'] ?? '',

                    ];

                    $CoOffAddress = implode(' ', array_filter($addressLines));

                    $CooffPin =  $companyData['data']['company']['business_address']['pincode'] ?? '';
                    $CooffState =  $companyData['data']['company']['business_address']['state'] ?? '';
                    $CooffCity =  $companyData['data']['company']['business_address']['city'] ?? '';

                    $companyRating = $companyData['data']['credit_ratings'][0]['rating'] ?? NULL;
                    $companyRatingDate = $companyData['data']['credit_ratings'][0]['rating_date'] ?? NULL;
                    $companyRatingAgency = $companyData['data']['credit_ratings'][0]['rating_agency'] ?? NULL;

                    if (!$companyData || !isset($companyData['data']['company'])) {
                        Log::info("Company not found for PAN: {$value->pan}");
                        DB::table('users_details_junk')->insert([
                            'name' => trim($companyName),
                            'contact_person' => trim($value->contact_person),
                            'email' => trim($companyEmail),
                            'pan' => trim($value->pan),
                            'mobile' => trim($value->mobile),
                            'zone' => trim($value->zone),
                            'class_type_id' => intval($value->class_type_id),
                            'fy_id' => intval($value->fy_id),
                            'bank_exposure' => floatval($value->bank_exposure),
                            'value_asset' => floatval($value->value_asset),
                            'loan_tenure' => floatval($value->loan_tenure),
                            'reg_off_add' => trim($companyAddress),
                            'reg_off_pin' => intval($companyPin),
                            'reg_off_state' => trim($companyState),
                            'reg_off_city' => trim($companyCity),
                            'created_by' => $value->created_by,
                            'bank_id' => intval($value->bank_id),
                            'borrower_type' => 'R',
                        ]);
                        DB::table('users_details_temp')->where('id', $value->id)->delete();
                    }

                        // Check if user exists based on PAN
                        $existingUser = User::where('pan', $value->pan)->first();

                        if ($existingUser) {
                            // If user exists, insert into BankFinancialDetails
                            $fincial = new BankFinancialDetails;

                              $adminUser = DB::table('users')->where('ifsc_code', $value->ifsc_code)->first();
                              $adminUserId_mapped_ifsc = $adminUser->id;

                            $fincial->fy_id = $value->fy_id;
                            $fincial->class_type_id = $value->class_type_id;
                            $fincial->com_id = $existingUser->id;
                            $fincial->bank_id =$adminUserId_mapped_ifsc;
                            $fincial->zone = $value->zone;
                            $fincial->bank_exposure = $value->bank_exposure;
                            $fincial->rating = $companyRating ?? NULL;
                            $fincial->rating_date = $companyRatingDate ?? NULL;
                            $fincial->rating_agency = $companyRatingAgency ?? NULL;

                            $fincial->save();

                            $data = ['role_id' => 4, 'model_type' => 'App\Models\User', 'model_id' => $existingUser->id];
                            DB::table('model_has_roles')->insert($data);
                            DB::table('users_details_temp')->where('id', $value->id)->delete();
                        } else {

                            $adminUser = DB::table('users')->where('ifsc_code', $value->ifsc_code)->first();
                            $adminUserId_mapped_ifsc = $adminUser->id;
                            $randomString = 'Password@1234';

                            $newuser = new User;
                            $newuser->name = $companyName;
                            $newuser->email = $companyEmail;
                            // $newuser->password=Hash::make($randomString);
                            $newuser->password='$2y$12$xTJrkHbaDKr7FvpU2xri.eM781kY1dna7XAGFbFkQMpMLQ1ZytU/C';
                            $newuser->mobile = $value->mobile;
                            $newuser->designation = $value->designation;
                            $newuser->cin_llpin = $companyCin;
                            $newuser->pan = $value->pan;
                            $newuser->contact_person = $value->contact_person;
                            $newuser->comp_type_id = $value->comp_type_id;
                            $newuser->sector_id = $value->sector_id;
                            $newuser->status = 'S';
                            $newuser->unique_login_id = $value->pan;
                            $newuser->borrower_type = 'C';
                            $newuser->isapproved = 'Y';
                            $newuser->created_by =  $adminUserId_mapped_ifsc;
                            $newuser->reg_off_add = $companyAddress;
                            $newuser->reg_off_pin = $companyPin;
                            $newuser->reg_off_state = $companyState;
                            $newuser->reg_off_city = $companyCity;
                            $newuser->co_off_add = $CoOffAddress;
                            $newuser->co_off_pin = $CooffPin;
                            $newuser->co_off_state = $CooffState;
                            $newuser->co_off_city = $CooffCity;
                            $newuser->isactive = 'Y';
                            $newuser->password_changed = 0;
                            $newuser->mobile_verified_at = Carbon::now();
                            $newuser->email_verified_at = Carbon::now();
                            $newuser->save();
                            if (!$newuser->exists) {
                                Log::error("Failed to create user for PAN: {$value->pan}");
                                continue;
                            }


                            // Insert into BankFinancialDetails
                            $fincial = new BankFinancialDetails;
                            $fincial->fy_id = $value->fy_id;
                            $fincial->class_type_id = $value->class_type_id;
                            $fincial->com_id = $newuser->id;
                            $fincial->bank_id =  $adminUserId_mapped_ifsc;
                            $fincial->zone = $value->zone;
                            $fincial->bank_exposure = $value->bank_exposure;
                            $fincial->rating = $companyRating ?? NULL;
                            $fincial->rating_date = $companyRatingDate ?? NULL;
                            $fincial->rating_agency = $companyRatingAgency ?? NULL;

                            $fincial->save();
                            if (!$fincial->exists) {
                                Log::error("Failed to insert financial details for PAN: {$value->pan}");
                            }

                            // Insert role into model_has_roles table
                            $data = ['role_id' => 4, 'model_type' => 'App\Models\User', 'model_id' => $newuser->id];
                            DB::table('model_has_roles')->insert($data);
                            DB::table('users_details_temp')->where('id', $value->id)->delete();
                        }

                        // Delete from temporary table after processing
                        DB::table('users_details_temp')->where('id', $value->id)->delete();


                } catch (\Exception $e) {
                    Log::error("Error processing record ID: " . $value->id . " - " . $e->getMessage());
                    Log::debug('API Response for PAN ' . $value->pan . ': ' . json_encode($companyData));

                }
            }

            // Log success after processing all records
            Log::info('Successfully processed and inserted records from users_details_temp.');
            return 'Process completed successfully.';

        } catch (\Exception $e) {
            Log::error('Error during FinalInsert process: ' . $e->getMessage());
            Log::debug("Processing record for PAN: {$value->pan}, Rating: {$companyRating}, Rating Date: {$companyRatingDate}, Rating Agency: {$companyRatingAgency}");
            return 'Error during the insert process: ' . $e->getMessage();
        }
    }


 public function FinalInsertRetail()
{
    try {

        $brrower_create_limit = config('constants.brrower_create_limit');
        if (empty($brrower_create_limit)) {
            throw new \Exception('Bank create limit is not set in the configuration');
        }

        // Fetch records from the temporary table
        $records = DB::table('users_details_temp')
                ->where('borrower_type','R')
            ->orderBy('id', 'ASC')
            ->take($brrower_create_limit)
            ->get();

        // Check if no records were found
        if ($records->isEmpty()) {
            Log::info('No records found in users_details_temp table.');
            return 'No records to process.';
        }

        foreach ($records as $key => $value) {

            try {

                 $newuser=User::where('pan', $value->pan)->first();
                  $randomString = $this->generateRandomString(8);
                //DB::beginTransaction();
                if (empty($newuser)) {
                            $newuser = new User;

                            $newuser->name = $value->name;
                            $newuser->email = $value->email;
                            // $newuser->password = Hash::make($randomString);
                            $newuser->password = '$2y$10$vTj1GhEjFcL0duMu1AqmGebo48zWZoxIuG8ThKXNfEDw7ltrUobTC';    // India@1234
                            $newuser->mobile = $value->mobile;
                            $newuser->pan = trim($value->pan);
                            $newuser->created_by = $value->created_by ;
                            $newuser->status = 'S' ;
                            $newuser->reg_off_add = $value->reg_off_add;
                            $newuser->reg_off_pin = $value->reg_off_pin;
                            $newuser->reg_off_state = $value->reg_off_state;
                            $newuser->reg_off_city = $value->reg_off_city;
                            $newuser->borrower_type = 'R';
                            $newuser->unique_login_id =  trim($value->pan);
                            $newuser->isapproved = 'Y';
                            $newuser->isactive = 'Y';
                            $newuser->mobile_verified_at = Carbon::now();
                            $newuser->email_verified_at = Carbon::now();
                            $newuser->save();
                        }

                        $fincial = new BankFinancialDetails;
                            $fincial->fy_id = $value->fy_id;;
                            $fincial->com_id = $newuser->id;
                            $fincial->bank_id = $value->bank_id;
                            $fincial->zone = $value->zone;
                            $fincial->class_type_id = $value->class_type_id;
                            $fincial->bank_exposure = $value->bank_exposure;
                            $fincial->value_asset = $value->value_asset;
                            $fincial->loan_tenure = $value->loan_tenure;
                            $fincial->save();

                $data = array('role_id' => 5, 'model_type' => 'App\User', 'model_id' => $newuser->id);
                DB::table('model_has_roles')->insert($data);

                // $data = array('name'=>$user->name,'email'=>$user->email,'unique_id'=>$user->unique_login_id,'password'=>$randomString,
                //              'bank_name'=>Auth::user()->name);

                //             //  dd($data);

                // Mail::send('emails.email_credentials', $data, function($message) use($data) {
                //    $message->to($data ['email'],$data ['name'])->subject
                //        ('Account Created | ESG - Dashboard ');
                //         // $message->cc('pliwg@ifciltd.com');
                //         // $message->bcc('shweta.rai@ifciltd.com');
                //   });

                // $SMS = new SubmissionSms();
                // $module = "Company-Created";
                // $com_name = $user->name;
                // $user_id = $user->unique_login_id;
                // $password = $randomString;
                // $bank_name = Auth::user()->name;
                // $smsResponse = $SMS->sendSMS($user->mobile, $module, $com_name, $user_id, $password, $bank_name);



                // DB::commit();
            } catch (\Exception $e) {
                            DB::table('users_details_junk')->insert([
                                'name' => trim($value->name),
                                'contact_person' => trim($value->name),
                                'email' =>trim($value->email),
                                'pan' =>trim( $value->pan),
                                'mobile' =>trim($value->mobile),
                                'zone' => trim($value->zone),
                                'class_type_id' => trim($value->class_type_id),
                                'fy_id' => trim($value->fy_id),
                                'bank_exposure' => trim($value->bank_exposure),
                                'value_asset' => trim($value->value_asset),
                                'loan_tenure' => trim($value->loan_tenure),
                                'reg_off_add' => trim($value->reg_off_add),
                                'reg_off_pin' => trim($value->reg_off_pin),
                                'reg_off_state' => trim($value->reg_off_state),
                                'reg_off_city' => trim($value->reg_off_city),
                                'created_by' => $value->created_by,
                                'bank_id' => $value->bank_id ,
                                'borrower_type' => 'R'
                        ]);

                          // Rollback in case of error and log the error
               // DB::rollBack();
                Log::error("Error processing record ID: " . $value->id . " - " . $e->getMessage());
            }
             DB::table('users_details_temp')->where('id', $value->id)->delete();
        }

        // Log success after processing all records
        Log::info('Successfully processed and inserted records from bank_details_temp.');

        return 'Process completed successfully.';

    } catch (\Exception $e) {
        // Log general errors (e.g., configuration issues)
        Log::error('Error during FinalInsert process: ' . $e->getMessage());
        return 'Error during the insert process: ' . $e->getMessage();
    }
}
    // CSV to ArrayData
    function csvToArray($filename = '', $delimiter = ',')
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

        private function generateRandomString($length = 5)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
