<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\QuestionValue;
use App\Models\BusinessActivityMast;
use App\Models\BusinessActivityValue;
use App\Models\InputSheetMast;
use App\Models\UnsdgValue;
use App\Models\DocumentUploads;
use App\Models\DocumentMaster;
use App\Models\DataQualityValue;
use App\Models\BankFinancialDetails;
use App\Models\PillarValue;
use Validator;


use Illuminate\Support\Facades\File;
use SimpleXMLElement;

class ThematicController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $pillar_mast = DB::table('pillar_master as pm')->where('status',1)->get();
        $pillar_ques = DB::table('pillar_ques_master as pqm')->where('status',1)->orderby('id')->get();
        $pillar_val = DB::table('pillar_value as pm')->where('com_id',$user->id)->get();
        // dd($pillar_mast,$pillar_ques, $pillar_val );

        return view('user.thematic.index', compact('pillar_mast','pillar_ques','pillar_val','user'));

    }

    public function pillar($pillar_id)
    {
        $pillar_id = decrypt($pillar_id);
        // dd($pillar_id);

        $user = Auth::user();

        $pillar_ques = DB::table('pillar_ques_master as pqm')
                                ->join('pillar_master as pm','pm.id','pqm.pillar_id')
                                ->where('pqm.pillar_id',$pillar_id)
                                ->where('pqm.status',1)
                                ->orderby('pqm.id')
                                ->get(['pqm.*','pm.name as pillar_name']);

        // dd($pillar_ques);

        return view('user.thematic.create', compact('pillar_ques','user'));

    }


    public function store(Request $request)
    {
        // dd($request);
        // try {
            $user = Auth::user();

            DB::transaction(function () use ($request)
            {
                foreach ($request->part as $value) {
                    // if(isset($value['check']))
                    // {
                        $data = new PillarValue;
                            $data->com_id = Auth::user()->id ;
                            $data->pillar_id = isset($request->pillar_id) ? $request->pillar_id : null ;
                            $data->ques_id = isset($value['ques_id']) ? $value['ques_id'] : null ;
                            $data->value = isset($value['value']) ? $value['value'] : null ;
                        $data->save();
                    // }
                }
            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            // return redirect()->back();
            return redirect()->route('user.thematic.edit',['com_id' => encrypt($user->id) ,'pillar_id' => encrypt($request->pillar_id)]);
        // } catch (\Exception $e) {
        //     alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     // errorMail($e, $request->id, Auth::user()->id);
        //     return redirect()->back();
        // }
    }

    public function edit($com_id,$pillar_id)
    {
        $com_id = decrypt($com_id);
        $pillar_id = decrypt($pillar_id);
        // dd($com_id,$pillar_id);

        $user = Auth::user();

        $pillar_val = DB::table('pillar_value as pv')
                            ->join('pillar_ques_master as pqm','pqm.id','pv.ques_id')
                            ->join('pillar_master as pm','pm.id','pqm.pillar_id')
                            ->where('pv.com_id',$com_id)
                            ->where('pv.pillar_id',$pillar_id)
                            ->get(['pv.*','pqm.name','pm.name as pillar_name','pqm.data_type']);
            // dd($pillar_val);

        $pillar_ques = DB::table('pillar_ques_master as pqm')
                                ->join('pillar_master as pm','pm.id','pqm.pillar_id')
                                ->where('pqm.pillar_id',$pillar_id)
                                ->where('pqm.status',1)
                                ->orderby('pqm.id')
                                ->get(['pqm.*','pm.name as pillar_name']);

        return view('user.thematic.edit', compact('pillar_val','pillar_ques','user'));
    }


    public function update(Request $request)
    {
        // dd($request);
        try{
            DB::transaction(function () use ($request)
            {
                foreach ($request->part as $val) {
                    $data = PillarValue::find($val['row_id']);
                        $data->value = isset($val['value']) ? $val['value'] : null;
                        $data->updated_at = Carbon::now();
                    $data->save();
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
// dd($request->undertaking,"d");
            DB::transaction(function () use ($request, $user)
            {
                $input_mast = InputSheetMast::where('id', $request->input_id)->first();
                    $input_mast->status = 'S';
                    $input_mast->is_checked = isset($request->undertaking) ? 1 : 0;
                    $input_mast->submitted_at = Carbon::now();
                $input_mast->save();
            });
            alert()->Success('Input Sheet Submitted Successfully', 'Success')->persistent('Close');
            return redirect()->route('user.fy');


        }catch (\Exception $e)
        {
            alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
    }


    public function view($bank_id,$class_type,$com_id,$fy_id)
    {
        $class_type = decrypt($class_type);
        $bank_id = decrypt($bank_id);
        $com_id = decrypt($com_id);
        $fy_id = decrypt($fy_id);

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
                                ->where('bfd.bank_id', $bank_id)
                                ->where('bfd.class_type_id', $class_type)
                                ->first(['bfd.*','u.name as bank_name','ctm.name as loan_type']);

        // dd($ques_mast,$ques_value);

        // $subques_mast = DB::table('subques_master')->where('sector_id',$user->sector_id)->orderby('id')->get();

        return view('user.questionnaire_view', compact('ques_mast','fy_id','user','ques_value','sector','fys','seg_mast','busi_mast','busi_value','data_quality','data_qual_value','bank_details'));

    }

}


