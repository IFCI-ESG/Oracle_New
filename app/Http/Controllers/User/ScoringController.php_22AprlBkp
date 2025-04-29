<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScoringQuestionMaster;
use App\Models\ScoringQuestionValue;
use App\Models\ModuleMast;
use App\Models\User;
use Auth;
use DB;
use Carbon\Carbon;

class ScoringController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $fys = DB::table('fy_masters')->where('status', '1')->orderby('start_date','desc')->get();
        $score_value = ScoringQuestionValue::where('com_id', $user->id)->orderby('id')->get();
        $module_mast = ModuleMast::where('com_id', $user->id)->where('module_type','SCORING')->orderby('id')->get();
    //   dd($module_mast);
        return view('user.scoring.index', compact('user','fys','score_value','module_mast'));

    }

    public function create($fy_id)
    {
        $fy_id = decrypt($fy_id);
        $user = Auth::user();
        $mod_mast = ModuleMast::where('com_id', $user->id)->where('fy_id',$fy_id)->where('module_type','SCORING')->first();
        // DB::transaction(function () use ($fy_id,$user,$mod_mast)
        // {
        //     if(!$mod_mast)
        //     {

        //         $module_mast = new ModuleMast;
        //         $module_mast->com_id = $user->id;
        //         $module_mast->status = 'D';
        //         $module_mast->fy_id = $fy_id;
        //         $module_mast->module_type = 'SEQ';
        //         $module_mast->save();
        //     }
        // });
        $quesMast = ScoringQuestionMaster::where('status', 1)->orderby('id')->get();
        $question=[];
        foreach ($quesMast as $key => $value) {
            $question[$value->piller][$value->subpiller][]  =$value;

        }
        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        // dd('d');
        return view('user.scoring.create', compact('question','user','fys','fy_id','mod_mast'));
    }

    public function store(Request $request)
    {


        $validated = $request->validate([
            'fy_id' => 'required|integer',
            'com_id' => 'required|integer',
            'answer' => 'required|array',
            'answer.*' => 'nullable|integer',
        ]);

        try {
            $module_mast = ModuleMast::where('com_id',$request->com_id)->where('fy_id',$request->fy_id)->where('module_type','SCORING')->first();
            $user = Auth::user();
            if(empty($module_mast))
            {
                $module_mast = new ModuleMast;
                $module_mast->com_id = $user->id;
                $module_mast->status = 'D';
                $module_mast->fy_id = $validated['fy_id'];
                $module_mast->module_type = 'SCORING';
                $module_mast->save();
            }

            DB::transaction(function () use ($validated,$module_mast)
            {

                foreach ($validated['answer'] as $qst_id => $answer) {

                    ScoringQuestionValue::create([
                        'module_mast_id' =>$module_mast->id,
                        'fy_id' => $validated['fy_id'],
                        'com_id' => $validated['com_id'],
                        'ques_id' => $qst_id,
                        'value' => $answer,
                    ]);
                }
            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->route('user.scoring.edit',encrypt($module_mast->id));
        } catch (\Exception $e) {
dd( $e->getMessage());
            alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
    }
//     public function show($id)
//     {
//          $id = decrypt($id);
//         $user = Auth::user();
//         $module_mast = ModuleMast::where('id', $id)->first();
//         $scoring_value = ScoringQuestionValue::where('module_mast_id', $id)->get()->toArray();

//         $quesMast = ScoringQuestionMaster::where('status', 1)->orderby('id')->get();
//         $total_max=0;
//         $total_obt=0;
//         $environment_max=0;
//         $environment_obt=0;
//         $social_max=0;
//         $social_obt=0;
//         $governance_max=0;
//         $governance_obt=0;

//         $question=[];
//         foreach ($quesMast as $key => $value) {

//                 $total_max=$total_max+10;
//             if ($value['piller']=='Environment') {
//                 $environment_max=$environment_max+10;
//             }
//             if ($value['piller']=='Social') {
//                $social_max=$social_max+10;
//             }
//             if ($value['piller']=='Governance') {
//                $governance_max=$governance_max+10;
//             }
//             $result = array_search($value['id'], array_column($scoring_value, 'ques_id'));
//             if ($result !== false) {
//                 $value['module_mast_id']=$scoring_value[$result]['module_mast_id'];
//                 $value['com_id']=$scoring_value[$result]['com_id'];
//                 $value['ques_id']=$scoring_value[$result]['ques_id'];
//                 $value['fy_id']=$scoring_value[$result]['module_mast_id'];
//                 $value['ans']=$scoring_value[$result]['value'];
//                 $value['value_table_id']=$scoring_value[$result]['id'];

//                 if ($value['piller']=='Environment') {
//                     $mark_e=$scoring_value[$result]['value']*2.5;
//                 $environment_obt=$environment_obt+ $mark_e;
//             }
//             if ($value['piller']=='Social') {
//                 $mark_s=$scoring_value[$result]['value']*2.5;
//                $social_obt=$social_obt+ $mark_s;
//             }
//             if ($value['piller']=='Governance') {
//                 $mark_v=$scoring_value[$result]['value']*2.5;
//                $governance_obt=$governance_obt+ $mark_v;
//             }
//             $mark_total=$scoring_value[$result]['value']*2.5;
//             $total_obt=$total_obt+$mark_total;
//             } else {
//                 $value['module_mast_id']="";
//                 $value['com_id']="";
//                 $value['ques_id']="";
//                 $value['fy_id']="";
//                 $value['ans']="";
//                 $value['ans_table_id']="";
//             }
//             $question[$value->piller][$value->subpiller][]  =$value;
//         }



//         $environment_final=round(($environment_obt/$environment_max)*10,3);
//         $social_final=round(($social_max/$social_max)*10,3);
//         $governance_final=round(($governance_obt/$governance_max)*10,3);

//       $sector = DB::table('sector_master')->where('id',$user->sector_id)->first();

//       $environment_esg_score=round((($environment_final*$sector->exposure_per_environment)/100),3);
//       $social_esg_score=round((($social_final*$sector->exposure_per_social)/100),3);
//       $governance_esg_score=round((($governance_final*$sector->exposure_per_governance)/100),3);

//       $total_esg_score=round( ($environment_esg_score+$social_esg_score+$governance_esg_score),3);

//       $rating = DB::table('rating_master')->whereRaw('number_range @> ?', ["[$total_esg_score, $total_esg_score]"])->first();
//       $rating_name=$rating->rating_name;
//       $rating_grade=$rating->rating_grade;

//         $fys = DB::table('fy_masters')->where('id',$module_mast->fy_id)->first();
//         return view('user.scoring.view', compact('question','scoring_value','fys','module_mast','user','rating_name','rating_grade','environment_esg_score',
// 'social_esg_score', 'governance_esg_score'));
//     }

public function show($id)
{
    $id = decrypt($id);
    $user = Auth::user();
    $module_mast = ModuleMast::where('id', $id)->first();
    $scoring_value = ScoringQuestionValue::where('module_mast_id', $id)->get()->toArray();

    $quesMast = ScoringQuestionMaster::where('status', 1)->orderby('id')->get();
    $total_max = 0;
    $total_obt = 0;
    $environment_max = 0;
    $environment_obt = 0;
    $social_max = 0;
    $social_obt = 0;
    $governance_max = 0;
    $governance_obt = 0;

    $question = [];
    foreach ($quesMast as $key => $value) {

        $total_max = $total_max + 10;


        if ($value['piller'] == 'Environment') {
            $environment_max = $environment_max + 10;
        }

        if ($value['piller'] == 'Social') {
            $social_max = $social_max + 10;
        }
        if ($value['piller'] == 'Governance') {
            $governance_max = $governance_max + 10;
        }


        $result = array_search($value['id'], array_column($scoring_value, 'ques_id'));
        if ($result !== false) {
            $value['module_mast_id'] = $scoring_value[$result]['module_mast_id'];
            $value['com_id'] = $scoring_value[$result]['com_id'];
            $value['ques_id'] = $scoring_value[$result]['ques_id'];
            $value['fy_id'] = $scoring_value[$result]['module_mast_id'];
            $value['ans'] = $scoring_value[$result]['value'];
            $value['value_table_id'] = $scoring_value[$result]['id'];

            if ( (isset($value['option1']) == 'Yes') &&  (isset($value['option2']) == 'No')) {
                    $mark = $scoring_value[$result]['value'] == 1 ? 10 : 1;
                }
                elseif ((isset($value['option1']) != 'Yes') &&  (isset($value['option2']) != 'No')) {
                    if ($scoring_value[$result]['value'] == 1) {
                        $mark = 1;
                    } elseif ($scoring_value[$result]['value'] == 2) {
                        $mark = 4;
                    } elseif ($scoring_value[$result]['value'] == 3) {
                        $mark = 7;
                    } else if($scoring_value[$result]['value'] == 4) {
                        $mark = 10;
                    }
                }

            if ($value['piller'] == 'Environment') {
                $environment_obt += $mark;
            }
            if ($value['piller'] == 'Social') {
                $social_obt += $mark;
            }
            if ($value['piller'] == 'Governance') {
                $governance_obt += $mark;
            }


            $total_obt += $mark;
        } else {

            $value['module_mast_id'] = "";
            $value['com_id'] = "";
            $value['ques_id'] = "";
            $value['fy_id'] = "";
            $value['ans'] = "";
            $value['ans_table_id'] = "";
        }


        $question[$value->piller][$value->subpiller][] = $value;
    }

    // Final score calculations
    $environment_final = round(($environment_obt / $environment_max) * 10, 3);
    $social_final = round(($social_obt / $social_max) * 10, 3);
    $governance_final = round(($governance_obt / $governance_max) * 10, 3);

    // ESG score calculations based on sector exposure
    $sector = DB::table('sector_master')->where('id', $user->sector_id)->first();
    
    $environment_esg_score = round((($environment_final * $sector->exposure_per_environment) / 100), 3);
    $social_esg_score = round((($social_final * $sector->exposure_per_social) / 100), 3);
    $governance_esg_score = round((($governance_final * $sector->exposure_per_governance) / 100), 3);

    $total_esg_score = round(($environment_esg_score + $social_esg_score + $governance_esg_score), 3);

    // Rating based on the calculated ESG score
    $rating = DB::table('rating_master')->whereRaw('number_range @> ?', ["[$total_esg_score, $total_esg_score]"])->first();
    $rating_name = $rating->rating_name;
    $rating_grade = $rating->rating_grade;

    // Get financial year data
    $fys = DB::table('fy_masters')->where('id', $module_mast->fy_id)->first();

    // Return the view with all necessary data
    return view('user.scoring.view', compact('question', 'scoring_value', 'fys', 'module_mast', 'user', 'rating_name', 'rating_grade', 'environment_esg_score', 'social_esg_score', 'governance_esg_score'));
}

  public function update(Request $request)
    {
        $validated = $request->validate([
            'fy_id' => 'required|integer',
            'com_id' => 'required|integer',
            'module_mast_id' => 'required|integer',
            'answer' => 'required|array',
            'answer.*' => 'nullable|integer',
        ]);
        try{
            DB::transaction(function () use ($validated)
            {
                foreach ($validated['answer'] as $qst_id => $answer) {
                    $scor_ans = ScoringQuestionValue::where('module_mast_id', $validated['module_mast_id'])->where('fy_id', $validated['fy_id'])->where('com_id', $validated['com_id'])->where('ques_id', $qst_id)->first();
                    if ($scor_ans) {
                        $scor_ans->value = $answer;
                        $scor_ans->save();
                    }else{
                        ScoringQuestionValue::create([
                            'module_mast_id' =>$validated['module_mast_id'],
                            'fy_id' => $validated['fy_id'],
                            'com_id' => $validated['com_id'],
                            'ques_id' => $qst_id,
                            'value' => $answer,
                        ]);
                    }
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

    public function edit($id)
    {
        $id = decrypt($id);
        $user = Auth::user();
        $module_mast = ModuleMast::where('id', $id)->first();
        $scoring_value = ScoringQuestionValue::where('module_mast_id', $id)->get()->toArray();
        $quesMast = ScoringQuestionMaster::where('status', 1)->orderby('id')->get();

        $question=[];
        foreach ($quesMast as $key => $value) {
            $result = array_search($value['id'], array_column($scoring_value, 'ques_id'));
            if ($result !== false) {
                $value['module_mast_id']=$scoring_value[$result]['module_mast_id'];
                $value['com_id']=$scoring_value[$result]['com_id'];
                $value['ques_id']=$scoring_value[$result]['ques_id'];
                $value['fy_id']=$scoring_value[$result]['module_mast_id'];
                $value['ans']=$scoring_value[$result]['value'];
                $value['value_table_id']=$scoring_value[$result]['id'];
            } else {
                $value['module_mast_id']="";
                $value['com_id']="";
                $value['ques_id']="";
                $value['fy_id']="";
                $value['ans']="";
                $value['ans_table_id']="";
            }
            $question[$value->piller][$value->subpiller][]  =$value;
        }
        $fys = DB::table('fy_masters')->where('id',$module_mast->fy_id)->first();
        return view('user.scoring.edit', compact('question','scoring_value','fys','module_mast','user'));
    }


    public function finalsubmit(Request $request, $id)
    {

        $id = decrypt($id);
        $user = Auth::user();
        $user_id = $user->id;


        try {
            DB::transaction(function () use ($id, $user_id) {
                $module_mast = ModuleMast::find($id);
                $scoring_value = ScoringQuestionValue::where('module_mast_id', $id)->get()->toArray();

                $quesMast = ScoringQuestionMaster::where('status', 1)->orderby('id')->get();
                if ($module_mast) {
                    $module_mast->status = 'S';
                    if ($module_mast->com_id != $user_id) {
                        throw new \Exception("Unauthorized: This module does not belong to the current user.");
                    }
                    $module_mast->save();
                } else {
                    throw new \Exception("ModuleMast record not found with ID: " . $id);
                }
            });

          return redirect('/user/scoring')->with('success', 'Rating Submitted Successfully');

        } catch (\Exception $e) {

            \Log::error("Error submitting module: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during submission: ' . $e->getMessage());
        }
    }

}

