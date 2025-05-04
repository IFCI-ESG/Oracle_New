<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
 use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\QuestionValue;
use App\Models\BusinessActivityMast;
use App\Models\BusinessActivityValue;
use App\Models\InputSheetMast;
use App\Models\UnsdgValue;
use App\Models\DocumentUploads;
use App\Models\DocumentMaster;
use App\Models\DataQualityValue;
use Illuminate\Support\Facades\Log;
use App\Models\BankFinancialDetails;
use Validator;


use Illuminate\Support\Facades\File;
use SimpleXMLElement;

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as u','u.id','bfd.bank_id')
                                ->join('class_type_master as ctm','ctm.id','bfd.class_type_id')
                                ->where('com_id', $user->id)
                                ->distinct('bank_id')
                                ->get(['bfd.*','u.name as bank_name','ctm.name as loan_type']);

        // dd($bank_details);

        return view('user.environment', compact('user'));

    }

    public function climate()
    {
        $user = Auth::user();

        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as u','u.id','bfd.bank_id')
                                ->join('class_type_master as ctm','ctm.id','bfd.class_type_id')
                                ->where('com_id', $user->id)
                                ->distinct('bank_id')
                                ->get(['bfd.*','u.name as bank_name','ctm.name as loan_type']);

        // dd($bank_details);

        return view('user.climate', compact('user'));

    }

    public function risk()
    {
        $user = Auth::user();

        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as u','u.id','bfd.bank_id')
                                ->join('class_type_master as ctm','ctm.id','bfd.class_type_id')
                                ->where('com_id', $user->id)
                                ->distinct('bank_id')
                                ->get(['bfd.*','u.name as bank_name','ctm.name as loan_type']);

        // dd($bank_details);

        return view('user.risk', compact('user'));

    }

    public function bank()
    {
        $user = Auth::user();

        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as au', 'au.id', '=', 'bfd.bank_id') // Join branches (users table represents branches)
                                ->join('users as bank', 'bank.id', '=', 'au.created_by') // Get bank details using created_by column
                                ->join('class_type_master as ctm', 'ctm.id', '=', 'bfd.class_type_id') // Join loan types
                                ->where('bfd.com_id', $user->id) // Filter by the user ID
                                ->select([
                                    'au.id as branch_id',
                                    'ctm.id as class_type_id',
                                    'bank.name as bank_name',      // Bank name from users
                                    'au.name as branch_name',      // Branch name from users
                                    'ctm.name as loan_type' // Count loans for the same branch and type
                                ])
                                ->groupBy('ctm.id','au.id','bank.name', 'au.name', 'ctm.name') // Group by bank, branch, and loan type
                                ->orderBy('au.name')  // Sort by branch name
                                ->orderBy('ctm.name') // Sort by loan type within branch
                                ->get();

        // dd($bank_details);

        return view('user.bank_selection', compact('bank_details','user'));

    }

    public function fy($branch_id,$class_type)
    {
        $class_type = decrypt($class_type);
        $branch_id = decrypt($branch_id);

        $user = Auth::user();

        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as au','au.id','bfd.bank_id')
                                ->join('class_type_master as ctm','ctm.id','bfd.class_type_id')
                                ->where('bfd.com_id', $user->id)
                                ->where('bfd.bank_id', $branch_id)
                                ->where('bfd.class_type_id', $class_type)
                                ->first(['bfd.*', 'bfd.bank_id as branch_id', 'au.name as bank_name','ctm.name as loan_type']);

        $ques = QuestionValue::where('com_id', $user->id)->orderby('id')->get();

        $input_mast = DB::table('inputsheet_mast')
                        ->where('com_id', $user->id)
                        ->get();

        $fys = DB::table('fy_masters')
                ->select('fy_masters.*')
                ->leftJoin('inputsheet_mast', function($join) use ($user) {
                    $join->on('fy_masters.id', '=', 'inputsheet_mast.fy_id')
                        ->where('inputsheet_mast.com_id', '=', $user->id)
                        ->where('inputsheet_mast.status', '=', 'S');
                })
                ->orderBy('fy_masters.id', 'desc')
                ->get();

        return view('user.fy', compact('fys','ques','input_mast','user','bank_details'));
    }

    public function updateAccount(Request $request)
    {
      try {

          $user = User::find(auth()->user()->id);

          if($user->password_changed == 1){

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
              return redirect('/login')->with('success', 'Password updated. Please log in.');
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


    public function activity_store(Request $request)
    {
        // dd($request);
        try {
            DB::transaction(function () use ($request)
            {
                foreach ($request->business as $value)
                {
                    // if(isset($value['check']))
                    // {
                        $business_activ = new BusinessActivityValue;
                            $business_activ->com_id = Auth::user()->id;
                            $business_activ->activity_id = isset($value['part_id']) ? $value['part_id'] : null;
                            $business_activ->is_checked = isset($value['check']) ? 1 : 0;
                            $business_activ->fy_id = $request->fy_id;
                        $business_activ->save();
                    // }
                }
            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
            // errorMail($e, $request->id, Auth::user()->id);
            return redirect()->back();
        }
    }

    public function xml()
    {
        $user = Auth::user();

        $ques = QuestionValue::where('com_id', $user->id)->get();

        $fys = DB::table('fy_masters')->get();

        // dd($ques);

        return view('user.xml', compact('fys','ques'));

    }

    public function xml_store(Request $request)
    {

        // ------------------------------------ 1st

        $xmlString = File::get($request->pan);
        $xml = new SimpleXMLElement($xmlString);

        // Process the XML data as needed
        // Example: Retrieve values from specific elements
        $title = (string) $xml->title;
        $author = (string) $xml->author;

        // Return the extracted data or perform any further actions
        // return response()->json([
        //     'title' => $title,
        //     'author' => $author,
        // ]);



        // ----------------------------------- 2nd
        $xmlString = file_get_contents($request->pan);
        $xmlObject = simplexml_load_string($xmlString);

        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);


        // ---------------------------------------

        $xml=simplexml_load_file($request->pan);
        $json = json_encode($xml);
        $phpArray = json_decode($json, true);

        dd($xml,$json,$phpArray);


        dd($phpArray,$xmlString,$xmlObject,$xml,$title,$author );


        $user = Auth::user();

        $ques = QuestionValue::where('com_id', $user->id)->get();

        $fys = DB::table('fy_masters')->get();

        // dd($ques);

        return view('user.xml', compact('fys','ques'));

    }

    public function addquestionnaire($branch_id,$class_type,$fy_id)
    {
        $class_type = decrypt($class_type);
        $branch_id = decrypt($branch_id);
        $fy_id = decrypt($fy_id);

        $user = Auth::user();

        DB::transaction(function () use ($fy_id,$user)
        {
            $chk = InputSheetMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
            if(!$chk)
            {
                $input_sheet = new InputSheetMast;
                    $input_sheet->com_id = $user->id;
                    $input_sheet->status = 'D';
                    $input_sheet->fy_id = $fy_id;
                $input_sheet->save();
            }
        });

        $sector = DB::table('sector_master')->where('id',$user->sector_id)->first();

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

        $busi_mast = BusinessActivityMast::where('sector_id', $user->sector_id)->where('ques_type_id',$user->comp_type_id)->orderby('id')->get();

        $busi_value = DB::table('business_activity_value as bav')
                            ->join('business_activity_master as bam','bam.id','bav.activity_id')
                            ->where('bav.com_id',$user->id)
                            ->where('bav.fy_id',$fy_id)
                            ->orderby('bav.id')
                            ->get(['bav.*','bam.activity']);

        // dd($user->sector_id,$busi_mast,$busi_value);
        // dd($fys);

        //   if(isset($ques)){
        //      return redirect()->route('user.editquestionnaire');
        //     }

        // $sec_seg_head=DB::table('sec_seg_head_mapping')->orderby('id')->get();

        $seg_mast = DB::table('segmentmaster as sgm')
                            ->join('sectorsegmentmapping as ssm','ssm.segment_id','sgm.id')
                            ->join('scopemaster as sm','sm.id','sgm.scopeid')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('ssm.sector_id',$user->sector_id)
                            ->orderby('sgm.ordernumber')
                            ->get(['sgm.*','sm.name as scope_name']);
            // dd($seg_mast);
        $ques_value = DB::table('question_value as qv')
                            ->join('question_master as qm','qm.id','=','qv.ques_id')
                            ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('qv.com_id',$user->id)
                            ->get(['qv.*','ssm.segment_id']);
            // dd($ques_value);

        $ques_mast = DB::table('question_master as qm')
                            ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('ssm.sector_id',$user->sector_id)
                            ->orderby('qm.id')->get();


        $seg_tot=count($seg_mast);
        $ques_tot= DB::table('question_value as qv')
                            ->join('question_master as qm','qm.id','=','qv.ques_id')
                            ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('qv.com_id',$user->id)
                            ->where('qv.fy_id',$fy_id)
                            ->distinct()
                            ->count('ssm.segment_id');

        $data_quality = DB::table('data_quality_master as dqm')->get();

        $data_qual_value = DB::table('data_quality_value as dqv')
                                ->join('data_quality_master as dqm','dqm.id','=','dqv.data_quality_id')
                                ->where('com_id',$user->id)
                                ->where('fy_id',$fy_id)
                                ->get(['dqv.*','dqm.name']);

        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as au','au.id','bfd.bank_id')
                                ->join('class_type_master as ctm','ctm.id','bfd.class_type_id')
                                ->where('bfd.com_id', $user->id)
                                ->where('bfd.bank_id', $branch_id)
                                ->where('bfd.class_type_id', $class_type)
                                ->first(['bfd.*', 'bfd.bank_id as branch_id', 'au.name as bank_name','ctm.name as loan_type']);

        // dd($bank_details);

        return view('user.addquestionnaire', compact('ques_mast','fy_id','user','ques_value','sector','fys','seg_mast','busi_mast','busi_value','seg_tot','ques_tot','data_quality','data_qual_value','bank_details'));

    }

    public function getQuesData($sect_id,$seg_id)
    {
        $user = Auth::user();
        $busi_val = BusinessActivityValue::where('com_id', $user->id)->where('is_checked', true)->orderby('id')->get();

        $busi_val_ids = $busi_val->pluck('activity_id')->toArray();

        $ques_mast = DB::table('question_master as qm')
                        ->join('sectorsegmentmapping as ssm', 'ssm.id', '=', 'qm.sector_segment_map_id')
                        ->where('ssm.ques_type_id',$user->comp_type_id)
                        ->where('ssm.segment_id', $seg_id)
                        ->where('ssm.sector_id', $sect_id)
                        ->where(function ($query) use ($busi_val_ids) {
                            $query->where(function ($query) use ($busi_val_ids) {
                                foreach ($busi_val_ids as $id) {
                                    $query->orWhereRaw("REGEXP_LIKE(qm.business_activity_id, '(^|,)'||?||'(,|$)')", [$id]);
                                }
                            })
                            ->orWhereNull('qm.business_activity_id');
                        })
                        ->orderBy('qm.id')
                        ->get(['qm.*']);

        return response()->json(['data' => $ques_mast]);
    }

    public function getQuesData_view($seg_id,$fy_id)
    {
        // $quesId = $request->input('ques_id');
        $user = Auth::user();
        $ques_val = DB::table('question_value as qv')
                            ->join('question_master as qm','qm.id','qv.ques_id')
                            ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('ssm.segment_id', $seg_id)
                            ->where('qv.fy_id',$fy_id)
                            ->where('qv.com_id',$user->id)
                            ->get(['qv.*','qm.particular','qm.unit','qm.description','qm.data_source']);

        // dd($ques_val);

        return response()->json(['data' => $ques_val]);
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            DB::transaction(function () use ($request)
            {
                foreach ($request->ques as $value) {
                    // if(isset($value['check']))
                    // {
                        $ques_detail = new QuestionValue;
                            $ques_detail->com_id = Auth::user()->id;
                            $ques_detail->ques_id = isset($value['ques_id']) ? $value['ques_id'] : null;
                            $ques_detail->is_checked = isset($value['check']) ? 1 : 0;
                            $ques_detail->value = isset($value['value']) ? $value['value'] : null ;
                            $ques_detail->fy_id = $request->fy_id;
                        $ques_detail->save();
                    // }
                }
            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->back();
            // return redirect()->route('user.addquestionnaire');
        } catch (\Exception $e) {
            alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
            // errorMail($e, $request->id, Auth::user()->id);
            return redirect()->back();
        }
    }


    public function update(Request $request)
    {
        // dd($request);
        try{
            DB::transaction(function () use ($request)
            {
                foreach ($request->ques as $value) {
                    $data = QuestionValue::where('id', $value['row_id'])->first();
                    $data->fill([
                        'is_checked' =>isset($value['check']) ? 1 : 0,
                        'value' => isset($value['value']) ? $value['value'] : null ,
                        'updated_at'=>Carbon::now(),
                    ]);
                    $data->save();
                    // dd($data);
                }
            });

            alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
            return redirect()->back();
        }catch (\Exception $e)
        {
            alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
    }

    public function quality_store(Request $request)
    {
        try{
            $user=Auth::user();

            $valid = Validator::make($request->all(),[
                'part.*.data_quality_id' => array('required')
            ]);

            if($valid->fails()) {
                alert()->warning('Please Select the Data Quality', 'Warning')->persistent('Close');
                return redirect()->back();
            }

            DB::transaction(function () use ($request)
            {
                foreach ($request->part as $value)
                {
                    if(isset($value['row_id']))
                    {
                        $data = DataQualityValue::find($value['row_id']);
                            $data->data_quality_id = $value['data_quality_id'];
                        $data->save();
                    }
                    else
                    {
                        $data = New DataQualityValue;
                            $data->com_id = $request->com_id;
                            $data->fy_id = $request->fy_id;
                            $data->segment_id = $value['seg_id'];
                            $data->data_quality_id = $value['data_quality_id'];
                        $data->save();
                    }
                }
            });

            alert()->success('Data Stored Successfully', 'Success!')->persistent('Close');
            return redirect()->back();
        }catch (\Exception $e)
        {
            alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
    }

    public function print_preview($com_id,$fy_id,$bank_id,$class_type)
    {
        $fy_id = decrypt($fy_id);
        $com_id = decrypt($com_id);
        $bank_id = decrypt($bank_id);
        $class_type = decrypt($class_type);

        $user=Auth::user();

        $busi_acti = DB::table('business_activity_value as bav')
                            ->join('business_activity_master as bam','bam.id','=','bav.activity_id')
                            ->where('is_checked', true)
                            ->where('bav.com_id', $user->id)
                            ->where('bav.fy_id',$fy_id)
                            ->orderby('bav.id')
                            ->get(['bam.*']);

        $ques_val = DB::table('question_value as qv')
                        ->join('question_master as qm','qm.id','=','qv.ques_id')
                        ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                        ->join('segmentmaster as sm','sm.id','ssm.segment_id')
                        ->join('sector_master as sm2','sm2.id','ssm.sector_id')
                        ->where('ssm.ques_type_id',$user->comp_type_id)
                        ->where('qv.fy_id',$fy_id)
                        ->where('qv.com_id', $com_id)
                        ->get(['qv.*','sm.segmentname','sm.label','sm.id as segment_id','qm.particular as question','qm.unit']);

        $seg_mast = DB::table('segmentmaster as sgm')
                        ->join('sectorsegmentmapping as ssm','ssm.segment_id','sgm.id')
                        ->join('scopemaster as sm','sm.id','sgm.scopeid')
                        ->where('ssm.ques_type_id',$user->comp_type_id)
                        ->where('ssm.sector_id',$user->sector_id)
                        // ->orderby('sgm.id')
                        ->get(['sgm.*','sm.name as scope_name']);

        $scope_mast =  DB::table('scopemaster as sm')->get();

        // $seg_mast =  DB::table('sectorsegmentmapping as ssm')
        //                     ->join('segmentmaster as sm','sm.id','ssm.segment_id')
        //                     ->where('ssm.ques_type_id',$user->comp_type_id)
        //                     ->where('ssm.sector_id', $user->sector_id)
        //                     ->get(['sm.*']);

        $input_mast = InputSheetMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();

        $data_quality = DB::table('data_quality_value as dqv')
                            ->join('data_quality_master as dqm','dqm.id','dqv.data_quality_id')
                            ->where('com_id', $user->id)
                            ->where('fy_id',$fy_id)
                            ->get(['dqv.*','dqm.name']);


        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as u','u.id','bfd.bank_id')
                                ->join('class_type_master as ctm','ctm.id','bfd.class_type_id')
                                ->where('bfd.com_id', $com_id)
                                ->where('bfd.bank_id', $bank_id)
                                ->where('bfd.class_type_id', $class_type)
                                ->where('bfd.fy_id',$fy_id)
                                ->first(['bfd.*', 'bfd.bank_id as branch_id','u.name as bank_name','ctm.name as loan_type']);

        // dd($fy_id, $com_id,$bank_id, $class_type, $bank_details);

        return view('user.preview', compact('ques_val','seg_mast','busi_acti','input_mast','user','scope_mast','data_quality','bank_details'));

    }

    public function submit(Request $request)
    {
        // dd($request);
            $user=Auth::user();
        try{

            if(!$request->undertaking)
            {
                alert()->warning('Please Check Undertaking', 'Warning')->persistent('Close');
                return redirect()->back();
            }
            
            \Log::info('Starting submission process');
            \Log::info('Request data:', $request->all());
            
            DB::transaction(function () use ($request, $user)
            {
                $input_mast = InputSheetMast::where('id', $request->input_id)->first();
                
                if (!$input_mast) {
                    \Log::error('InputSheetMast not found for ID: ' . $request->input_id);
                    throw new \Exception('Input sheet not found');
                }
                
                \Log::info('Found InputSheetMast:', ['id' => $input_mast->id, 'current_status' => $input_mast->status]);
                
                $input_mast->status = 'S';
                $input_mast->is_checked = isset($request->undertaking) ? 1 : 0;
                $input_mast->submitted_at = Carbon::now();
                $input_mast->save();
                
                \Log::info('InputSheetMast updated successfully');
            });
            
            \Log::info('Transaction completed, redirecting to fy route');
            alert()->Success('Input Sheet Submitted Successfully', 'Success')->persistent('Close');
            return redirect()->route('user.fy',[
                'branch_id' => encrypt($request->bank_id),
                'class_type'=> encrypt($request->class_type)
            ]);

        }catch (\Exception $e)
        {
            \Log::error('Input Sheet Submission Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
    }


    public function view($branch_id,$class_type,$com_id,$fy_id)
    {
        $class_type = decrypt($class_type);
        $branch_id = decrypt($branch_id);
        $com_id = decrypt($com_id);
        $fy_id = decrypt($fy_id);
        // dd($class_type,$branch_id,$com_id,$fy_id );
        $user = User::where('id',$com_id)->first();
        // dd($user);
        $sector = DB::table('sector_master')->where('id',$user->sector_id)->first();

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

        $busi_mast = BusinessActivityMast::where('sector_id', $user->sector_id)->orderby('id')->get();

        $busi_value = DB::table('business_activity_value as bav')
                            ->join('business_activity_master as bam','bam.id','bav.activity_id')
                            ->where('is_checked', true)
                            ->where('bav.com_id',$user->id)
                            ->where('bav.fy_id',$fy_id)
                            ->orderby('bav.id')
                            ->get(['bav.*','bam.activity']);

        $seg_mast = DB::table('segmentmaster as sgm')
                            ->join('sectorsegmentmapping as ssm','ssm.segment_id','sgm.id')
                            ->join('scopemaster as sm','sm.id','sgm.scopeid')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('ssm.sector_id',$user->sector_id)
                            ->orderby('sgm.ordernumber')
                            ->get(['sgm.*','sm.name as scope_name']);
            // dd($seg_mast);
        $ques_value = DB::table('question_value as qv')
                            ->join('question_master as qm','qm.id','=','qv.ques_id')
                            ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('qv.com_id',$user->id)
                            ->get(['qv.*','ssm.segment_id']);
            // dd($ques_value);

        $ques_mast = DB::table('question_master as qm')
                            ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('ssm.sector_id',$user->sector_id)
                            ->orderby('qm.id')->get();


        $ques_value = DB::table('question_value')->where('com_id',$user->id)->where('fy_id',$fy_id)->get();

        $data_quality = DB::table('data_quality_master as dqm')->get();

        $data_qual_value = DB::table('data_quality_value as dqv')
                                ->join('data_quality_master as dqm','dqm.id','=','dqv.data_quality_id')
                                ->where('com_id',$user->id)
                                ->where('fy_id',$fy_id)
                                ->get(['dqv.*','dqm.name']);

        $bank_details = DB::table('bank_financial_details as bfd')
                                ->join('users as u','u.id','bfd.bank_id')
                                ->join('class_type_master as ctm','ctm.id','bfd.class_type_id')
                                ->where('bfd.com_id', $user->id)
                                ->where('bfd.bank_id', $branch_id)
                                ->where('bfd.class_type_id', $class_type)
                                ->first(['bfd.*','u.name as bank_name','ctm.name as loan_type']);

        // dd($ques_mast,$ques_value,$bank_details);

        // $subques_mast = DB::table('subques_master')->where('sector_id',$user->sector_id)->orderby('id')->get();

        return view('user.questionnaire_view', compact('ques_mast','fy_id','user','ques_value','sector','fys','seg_mast','busi_mast','busi_value','data_quality','data_qual_value','bank_details'));

    }

    public function getQuesData_onlyview($seg_id,$fy_id,$com_id)
    {
        // $quesId = $request->input('ques_id');
        $user = Auth::user();

        $ques_val = DB::table('question_value as qv')
                            ->join('question_master as qm','qm.id','qv.ques_id')
                            ->join('sectorsegmentmapping as ssm','ssm.id','qm.sector_segment_map_id')
                            ->where('ssm.ques_type_id',$user->comp_type_id)
                            ->where('ssm.segment_id', $seg_id)
                            ->where('qv.fy_id',$fy_id)
                            ->where('qv.com_id',$user->id)
                            ->get(['qv.*','qm.particular','qm.unit','qm.description','qm.data_source']);


        // dd($ques_val);

        return response()->json(['data' => $ques_val]);
    }

    public function store_undertaking_doc(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        $inputMast = InputSheetMast::find($request->input_id);

        $doctypes = DocumentMaster::where('doc_type', 'undertaking')->pluck('doc_type', 'doc_id')->toArray();
        try {
            DB::transaction(function () use ($request, $doctypes, $inputMast) {

                foreach ($doctypes as $docid => $doctype) {
                    // dd($request,$doctype);
                    // $uploadId = array();
                    if (isset($request->undertaking)) {
                        $newDoc = $request->undertaking;
                        // dd($newDoc);
                        $doc = new DocumentUploads;
                        // $doc->app_id = $appMast->id;
                        $doc->doc_id = $docid;
                        $doc->mime = $newDoc->getMimeType();
                        $doc->file_size = $newDoc->getSize();
                        $doc->updated_at = Carbon::now();
                        $doc->user_id = Auth::user()->id;
                        $doc->created_at = Carbon::now();
                        $doc->file_name = $newDoc->getClientOriginalName();
                        $doc->uploaded_file = fopen($newDoc->getRealPath(), 'r');
                        $doc->remarks = '';
                        $doc->save();
                        // array_push($uploadId, $doc->id);
                        // dd($doc->id);
                    }
                }

                $inputMast = InputSheetMast::find($request->input_id);

                $inputMast->undertaking_doc_id = $doc->id;

                $inputMast->save();


            });

            alert()->success('Preview Uploaded', 'Success!')->persistent('Close');
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }

    }

    public function update_undertaking_doc(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        $inputMast = InputSheetMast::where('id', $request->input_id)->first();

        $doctypes = DocumentMaster::where('doc_type', 'undertaking')->pluck('doc_type', 'doc_id')->toArray();
        try {
            DB::transaction(function () use ($request, $inputMast, $doctypes) {

                if (isset($request->undertaking)) {
                    foreach ($doctypes as $doctype) {
                        // dd($doctype);
                        $newDoc = $request[$doctype];
                        $doc = DocumentUploads::where('id', $request->undertaking_doc_id)->first();
                        // dd($doc);
                        $doc->mime = $newDoc->getMimeType();
                        $doc->file_size = $newDoc->getSize();
                        $doc->updated_at = Carbon::now();
                        $doc->user_id = Auth::user()->id;
                        $doc->file_name = $newDoc->getClientOriginalName();
                        $doc->uploaded_file = fopen($newDoc->getRealPath(), 'r');
                        // dd($doc);
                        $doc->save();
                    }
                }

            });

            alert()->success('Preview Updated', 'Success!')->persistent('Close');
            return redirect()->back();

        } catch (\Exception $e) {
            alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
    }

    public function downloadFile($id)
    {
        $doc =  DB::table('document_uploads')
        ->where('id',$id)
        // ->select('mime','file_name','uploaded_file')
        ->first();
        ob_start();
        fpassthru($doc->uploaded_file);
        $docc= ob_get_contents();
        ob_end_clean();
        // $ext = '';
        // if ($doc->mime == "application/pdf") {
        //     $ext = 'pdf';
        // } elseif ($doc->mime == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
        //     $ext = 'docx';
        // } elseif ($doc->mime == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
        //     $ext = 'xlsx';
        // } elseif ($doc->mime == "image/png") {
        //     $ext = 'png';
        // } elseif ($doc->mime == "image/jpeg") {
        //     $ext = 'jpg';
        // }

        return response($docc)
        ->header('Cache-Control', 'no-cache private')
        ->header('Content-Description', 'File Transfer')
        ->header('Content-Type', $doc->mime)
        ->header('Content-length', strlen($docc))
        ->header('Content-Disposition', 'attachment; filename='.$doc->file_name)
        ->header('Content-Transfer-Encoding', 'binary');

    }




}