<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\ModelHasRoles;
use App\QuestionnaireMast;
use Validator;
use CURLFile;
use Mail;


class ListController extends Controller
{

      public function index()
    {
        $company_list = DB::table('inputsheet_mast as im')
                    ->join('users as u','u.id','im.com_id')
                    ->join('sector_master as sm','sm.id','u.sector_id')
                    ->join('fy_masters as fy','fy.id','im.fy_id')
                    ->where('u.created_by',Auth::user()->id)
                    ->orderby('im.submitted_at', 'Asc')
                    ->get(['im.*','sm.name as sector','u.name','fy.fy','u.id as com_id']);
            // dd( $company_list);

        return view('admin.company_list.index',compact('company_list'));
    }

    public function view($com_id,$fy_id)
    {
        $com_id = decrypt($com_id);
        $fy_id = decrypt($fy_id);

        $user = User::where('id',$com_id)->first();
        // dd($user);
        $sector = DB::table('sector_master')->where('id',$user->sector_id)->first();
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        // $sec_seg=DB::table('sec_seg_mapping')->orderby('id')->get();

        $head_mast = DB::table('header_master as hm')
                        ->join('sec_seg_head_mapping as sshm','sshm.header_id','hm.id')
                        ->join('segment_master as sm','sm.id','hm.segment_id')
                        ->where('sshm.sector_id',$user->sector_id)
                        ->get(['hm.*','sshm.id as sec_seg_head_id','sshm.sector_id as sector_id','sm.id as segment_id']);

        // $ques_mast = DB::table('question_master as qm')
        //                 ->join('sec_seg_mapping as ssm','ssm.id','qm.sec_seg_mapping_id')
        //                 ->join('sector_master as sm','sm.id','ssm.sector_id')
        //                 ->join('segment_master as sgm','sgm.id','ssm.segment_id')
        //                 ->where('sm.id',$user->sector_id)
        //                 ->orderby('qm.id')
        //                 ->get(['qm.*','sm.id as sector_id','sgm.id as segment_id']);

        // dd($ques_mast);

        $ques_value = DB::table('question_value')->where('com_id',$user->id)->where('fy_id',$fy_id)->get();

        // dd($ques_mast,$ques_value);

        // $subques_mast = DB::table('subques_master')->where('sector_id',$user->sector_id)->orderby('id')->get();

        return view('admin.company_list.view', compact('head_mast','fy_id','user','ques_value','sector','fys'));

    }

    public function getSubQuesData_view($head_id,$fy_id,$com_id)
    {
        // $quesId = $request->input('ques_id');
        $user = Auth::user();

        $ques_val = DB::table('question_value as qv')
                            ->join('question_master as qm','qm.id','qv.ques_id')
                            ->join('sec_seg_head_mapping as sshm','sshm.id','qv.sec_seg_head_mapping_id')
                            ->where('qv.sec_seg_head_mapping_id', $head_id)
                            ->where('qv.fy_id',$fy_id)
                            ->where('qv.com_id',$com_id)
                            ->get(['qv.*','qm.particular','qm.unit','qm.descrption','qm.data_source']);

        // $ques_val = DB::table('question_value')
        //                     ->join('subques_master as sm','sm.id','question_value.subques_id')
        //                     ->where('question_value.ques_id', $ques_id)
        //                     ->where('question_value.fy_id',$fy_id)
        //                     ->where('question_value.com_id',$com_id)
        //                     ->get(['question_value.*','sm.particular','sm.unit','sm.descrption','sm.data_source']);

        // dd($ques_val);

        return response()->json(['data' => $ques_val]);
    }

  
}
