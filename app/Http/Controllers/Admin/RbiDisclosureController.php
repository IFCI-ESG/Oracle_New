<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AdminUser;
use App\Models\BankFinancialDetails;
use App\Models\RbiPillarValue;
use App\Models\RbiDisclosureMast;
use Validator;

use Illuminate\Support\Facades\File;
use SimpleXMLElement;

class RbiDisclosureController extends Controller
{

    public function index()
    {
        // dd('d');

        $fys = DB::table('fy_masters')->orderby('id','desc')->get();

        $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->orderby('id')->get();
        // dd($rbi_mast);

        // $pillar_mast = DB::table('rbi_pillar_master as pm')->where('status',1)->orderby('id')->get();
        // $pillar_ques = DB::table('rbi_pillar_ques_master as pqm')->where('status',1)->orderby('id')->get();
        $pillar_val = DB::table('rbi_pillar_value as rpv')
                            ->join('rbi_pillar_ques_master as rpqm','rpqm.id','rpv.ques_id')
                            ->where('bank_id',Auth::user()->id)
                            ->orderby('rpqm.id')
                            ->get(['rpv.*','rpqm.pillar_id']);

        // $pillar_val =  RbiPillarValue::where('com_id',Auth::user()->id)->get();
        // dd($pillar_mast,$pillar_ques, $pillar_val );

        return view('admin.rbi_disclosure.index', compact('rbi_mast','fys','pillar_val'));

    }

    public function pillar($fy_id)
    {
        $fy_id = decrypt($fy_id);

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

        $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->where('fy_id', $fy_id)->first();
            // dd($rbi_mast);
        $pillar_mast = DB::table('rbi_pillar_master as pm')->where('status',1)->orderby('id')->get();
        $pillar_ques = DB::table('rbi_pillar_ques_master as pqm')->where('status',1)->orderby('id')->get();
        $pillar_val = DB::table('rbi_pillar_value as rpv')
                            ->join('rbi_pillar_ques_master as rpqm','rpqm.id','rpv.ques_id')
                            ->where('bank_id',Auth::user()->id)
                            ->orderby('rpqm.id')
                            ->get(['rpv.*','rpqm.pillar_id']);

        return view('admin.rbi_disclosure.pillar', compact('pillar_mast','pillar_ques','pillar_val','fys','rbi_mast'));

    }

    public function create($pillar_id,$fy_id)
    {
        $pillar_id = decrypt($pillar_id);
        $fy_id = decrypt($fy_id);
        // dd($pillar_id,$fy_id);

        $user = Auth::user();

        $pillar_ques = DB::table('rbi_pillar_ques_master as pqm')
                                ->join('rbi_pillar_master as pm','pm.id','pqm.pillar_id')
                                ->where('pqm.pillar_id',$pillar_id)
                                ->where('pqm.status',1)
                                ->orderby('pqm.id')
                                ->get(['pqm.*','pm.name as pillar_name']);

        // dd($pillar_ques);

        return view('admin.rbi_disclosure.create', compact('pillar_ques','user','fy_id'));

    }


    public function store(Request $request)
    {
        // dd($request,$request->fy_id);
        // try {
            $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->where('fy_id',$request->fy_id)->first();
            DB::transaction(function () use ($request)
            {
                if(!$rbi_mast){
                    $rbi = new RbiDisclosureMast;
                        $rbi->bank_id = Auth::user()->id;
                        $rbi->status = 'D';
                        $rbi->fy_id = $request->fy_id;
                    $rbi->save();
                }

                // dd($rbi);

                foreach ($request->part as $value) {
                    if(isset($value['option']) || isset($value['value']))
                    {
                        $data = new RbiPillarValue;
                            $data->rbi_mast_id = $rbi->id ;
                            $data->bank_id = Auth::user()->id ;
                            $data->ques_id = isset($value['ques_id']) ? $value['ques_id'] : null ;
                            $data->option = isset($value['option']) ? $value['option'] : Null ;
                            $data->value = isset($value['value']) ? $value['value'] : null ;
                        $data->save();
                    }
                }
            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            // return redirect()->back();
            return redirect()->route('admin.rbi_disclosure.edit',['bank_id' => encrypt(Auth::user()->id) ,'pillar_id' => encrypt($request->pillar_id), 'fy_id' => encrypt($request->fy_id)]);
        // } catch (\Exception $e) {
        //     alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     // errorMail($e, $request->id, Auth::user()->id);
        //     return redirect()->back();
        // }
    }

    public function edit($bank_id,$pillar_id,$fy_id)
    {
        $bank_id = decrypt($bank_id);
        $pillar_id = decrypt($pillar_id);
        $fy_id = decrypt($fy_id);
        // dd($bank_id,$pillar_id);

       $pillar_val = DB::table('rbi_pillar_ques_master as rpqm')
                            ->leftJoin('rbi_pillar_value as rpv', function($join) use ($bank_id) {
                                $join->on('rpqm.id', '=', 'rpv.ques_id')
                                    ->where('rpv.bank_id', '=', $bank_id); // Ensures filtering only for a specific company
                            })
                            ->join('rbi_pillar_master as rpm', 'rpm.id', '=', 'rpqm.pillar_id')
                            ->where('rpqm.pillar_id', $pillar_id)
                            ->orderby('rpqm.id')
                            ->get([
                                'rpv.*', 
                                'rpqm.types_of_disclosure', 
                                'rpqm.ques',
                                'rpqm.id as ques_id', 
                                'rpm.name as pillar_name', 
                                'rpqm.data_type'
                            ]);
    
            // dd($pillar_val);

        return view('admin.rbi_disclosure.edit', compact('pillar_val','fy_id','pillar_id'));
    }


    public function update(Request $request)
    {
        // dd($request);
        // try{

            DB::transaction(function () use ($request)
            {
                $rbi_mast = RbiDisclosureMast::where('bank_id', Auth::user()->id)->where('fy_id',$request->fy_id)->first();

                foreach ($request->part as $val) {
                    if(isset($val['row_id']))
                    {
                        // dd($request,'f');
                        $data = RbiPillarValue::find($val['row_id']);
                            $data->option = isset($val['option']) ? $val['option'] : Null ;
                            $data->value = isset($val['value']) ? ((isset($val['option']) ? ($val['option'] == 'N' ? null : $val['value']) : $val['value'] )) : null;
                            $data->updated_at = Carbon::now();
                        $data->save();
                    }
                    else
                    {
                        if(isset($val['option']) || isset($val['value']))
                        {
                            $data = new RbiPillarValue;
                                $data->rbi_mast_id = $rbi_mast->id ;
                                $data->bank_id = Auth::user()->id ;
                                $data->ques_id = isset($val['ques_id']) ? $val['ques_id'] : null ;
                                $data->option = isset($val['option']) ? $val['option'] : Null ;
                                $data->value = isset($val['value']) ? $val['value'] : null ;
                            $data->save();
                        }
                    }
                }
            });

            alert()->success('Data Updated Successfully', 'Success!')->persistent('Close');
            return redirect()->back();
        // }catch (\Exception $e)
        // {
        //     alert()->Warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     return redirect()->back();
        // }
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
            return redirect()->route('admin.fy');    


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

        return view('admin.questionnaire_view', compact('ques_mast','fy_id','user','ques_value','sector','fys','seg_mast','busi_mast','busi_value','data_quality','data_qual_value','bank_details'));

    }

}


