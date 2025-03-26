<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GovernanceQuestionMaster;
use App\Models\GovernanceQuestionValue;
use App\Models\GovernanceMast;
use App\Models\User;
use App\Models\DocumentUploads;
use App\Models\DocumentMaster;
use Auth;
use DB;
use Carbon\Carbon;

class GovernanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $quesMast = GovernanceQuestionMaster::where('status', 1)->orderby('id')->get();
        $gov_value = GovernanceQuestionValue::where('com_id', $user->id)->orderby('id')->get();
        // dd($quesMast);

        $fys = DB::table('fy_masters')->orderby('id','desc')->get();

        $gov_mast = GovernanceMast::where('com_id', $user->id)->orderby('id')->get();
        // dd($gov_mast);

        return view('user.governance.index', compact('quesMast','user','fys','gov_mast','gov_value'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fy_id)
    {
        $fy_id = decrypt($fy_id);
        $user = Auth::user();

        $gov_mast = GovernanceMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();
        DB::transaction(function () use ($fy_id,$user,$gov_mast)
        {
            if(!$gov_mast)
            {
                $gov = new GovernanceMast;
                    $gov->com_id = $user->id;
                    $gov->status = 'D';
                    $gov->fy_id = $fy_id;
                $gov->save();
            }
        });

        $quesMast = GovernanceQuestionMaster::where('status', 1)->orderby('id')->get();

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

        return view('user.governance.create', compact('quesMast','user','fys','fy_id','gov_mast'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request);
        // try {
	        $gov_mast = GovernanceMast::where('com_id',$request->com_id)->where('fy_id',$request->fy_id)->first();

            DB::transaction(function () use ($request,$gov_mast)
            {
                foreach ($request->board as $val) {
                    $gov_data = new GovernanceQuestionValue;
                        $gov_data->com_id = $request->com_id;
                        $gov_data->gov_mast_id = $gov_mast->id;
                        $gov_data->fy_id = $request->fy_id;
                        $gov_data->ques_id = $val['ques_id'];
                        $gov_data->value = isset($val['value']) ? $val['value'] : null;
                        $gov_data->details = isset($val['details']) ? $val['details'] : null;
                    $gov_data->save();
                }

                foreach ($request->comp as $val) {
                    $gov_data = new GovernanceQuestionValue;
                        $gov_data->com_id = $request->com_id;
                        $gov_data->gov_mast_id = $gov_mast->id;
                        $gov_data->fy_id = $request->fy_id;
                        $gov_data->ques_id = $val['ques_id'];
                        $gov_data->complaints = isset($val['complaints']) ? $val['complaints'] : null;
                        $gov_data->no_of_complaints = isset($val['no_of_complaints']) ? $val['no_of_complaints'] : null;
                        $gov_data->no_of_pending_complaints = isset($val['no_of_pending_complaints']) ? $val['no_of_pending_complaints'] : null;
                    $gov_data->save();
                }

                foreach ($request->rnd as $val) {
                    $gov_data = new GovernanceQuestionValue;
                        $gov_data->com_id = $request->com_id;
                        $gov_data->gov_mast_id = $gov_mast->id;
                        $gov_data->fy_id = $request->fy_id;
                        $gov_data->ques_id = $val['ques_id'];
                        $gov_data->percentage = isset($val['percentage']) ? $val['percentage'] : null;
                    $gov_data->save();
                }

                foreach ($request->policy as $val) {
                    $gov_data = new GovernanceQuestionValue;
                        $gov_data->com_id = $request->com_id;
                        $gov_data->gov_mast_id = $gov_mast->id;
                        $gov_data->fy_id = $request->fy_id;
                        $gov_data->ques_id = $val['ques_id'];
                        $gov_data->policy_val = isset($val['policy_val']) ? $val['policy_val'] : null;
                    $gov_data->save();
                }

                foreach ($request->fine as $val) {
                    $gov_data = new GovernanceQuestionValue;
                        $gov_data->com_id = $request->com_id;
                        $gov_data->gov_mast_id = $gov_mast->id;
                        $gov_data->fy_id = $request->fy_id;
                        $gov_data->ques_id = $val['ques_id'];
                        $gov_data->fine_amt = isset($val['fine_amt']) ? $val['fine_amt'] : null;
                    $gov_data->save();
                }

            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->route('user.governance.edit',encrypt($gov_mast->id));
            // return redirect()->route('user.addquestionnaire');
        // } catch (\Exception $e) {
        //     alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        // dd($id);
        $gov_mast = GovernanceMast::where('id', $id)->first();
        $gov_value = GovernanceQuestionValue::where('gov_mast_id', $id)->get();
        $quesMast = GovernanceQuestionMaster::where('status', 1)->orderby('id')->get();
        $fys = DB::table('fy_masters')->where('id',$gov_mast->fy_id)->first();

        // dd($quesMast,$gov_value);
        return view('user.governance.edit', compact('quesMast','gov_value','fys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        // try{

            DB::transaction(function () use ($request)
            {
                foreach ($request->board as $val) {
                    $gov_data = GovernanceQuestionValue::find($val['row_id']);
                        $gov_data->value = isset($val['value']) ? $val['value'] : null;
                        $gov_data->details = isset($val['details']) ? $val['details'] : null;
                        $gov_data->updated_at = Carbon::now();
                    $gov_data->save();
                }

                foreach ($request->comp as $val) {
                    $gov_data = GovernanceQuestionValue::find($val['row_id']);
                        $gov_data->complaints = isset($val['complaints']) ? $val['complaints'] : null;
                        $gov_data->no_of_complaints = isset($val['no_of_complaints']) ? $val['no_of_complaints'] : null;
                        $gov_data->no_of_pending_complaints = isset($val['no_of_pending_complaints']) ? $val['no_of_pending_complaints'] : null;
                        $gov_data->updated_at = Carbon::now();
                    $gov_data->save();
                }

                foreach ($request->rnd as $val) {
                    $gov_data = GovernanceQuestionValue::find($val['row_id']);
                        $gov_data->percentage = isset($val['percentage']) ? $val['percentage'] : null;
                        $gov_data->updated_at = Carbon::now();
                    $gov_data->save();
                }

                foreach ($request->policy as $val) {
                    $gov_data = GovernanceQuestionValue::find($val['row_id']);
                        $gov_data->policy_val = isset($val['policy_val']) ? $val['policy_val'] : null;
                        $gov_data->updated_at = Carbon::now();
                    $gov_data->save();
                }

                foreach ($request->fine as $val) {
                    $gov_data = GovernanceQuestionValue::find($val['row_id']);
                        $gov_data->fine_amt = isset($val['fine_amt']) ? $val['fine_amt'] : null;
                        $gov_data->updated_at = Carbon::now();
                    $gov_data->save();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
