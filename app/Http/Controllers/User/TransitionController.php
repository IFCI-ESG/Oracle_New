<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ModuleMast;
use App\Models\TransitionQuestionValue;
use Auth;
use DB;
use Carbon\Carbon;

class TransitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fys = DB::table('fy_masters')->orderby('id','desc')->get();

        $module_mast = ModuleMast::where('module_type', 'Transition_Risk')->where('com_id', Auth::user()->id)->get();
        $transition_value = TransitionQuestionValue::where('com_id', Auth::user()->id)->orderby('id')->get();

        // dd($gov_mast);

        return view('user.transition.index', compact('fys','module_mast','transition_value'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fy_id)
    {
        // dd('d');
        $fy_id = decrypt($fy_id);

        $module_mast = ModuleMast::where('module_type', 'Transition_Risk')->where('com_id', Auth::user()->id)->where('fy_id',$fy_id)->first();

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $sector = DB::table('sector_master')->where('id',Auth::user()->sector_id)->first();
        $transition_ques = DB::table('transition_question_master')->get();

        return view('user.transition.create', compact('fys','fy_id','module_mast','sector','transition_ques'));
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
            $module_mast = new ModuleMast;
                $module_mast->com_id = $request->com_id;
                $module_mast->status = 'D';
                $module_mast->fy_id = $request->fy_id;
                $module_mast->module_type = 'Transition_Risk';

            DB::transaction(function () use ($request,$module_mast)
            {

                $module_mast->save();

                foreach ($request->policy as $val) {
                    $value = new TransitionQuestionValue;
                        $value->module_mast_id = $module_mast->id;
                        $value->com_id = $request->com_id;
                        $value->fy_id = $request->fy_id;
                        $value->ques_id = $val['ques_id'];
                        $value->value = isset($val['value']) ? $val['value'] : null;
                    $value->save();
                }

                foreach ($request->tech as $val) {
                    $value = new TransitionQuestionValue;
                        $value->module_mast_id = $module_mast->id;
                        $value->com_id = $request->com_id;
                        $value->fy_id = $request->fy_id;
                        $value->ques_id = $val['ques_id'];
                        $value->value = isset($val['value']) ? $val['value'] : null;
                    $value->save();
                }

                foreach ($request->market as $val) {
                    $value = new TransitionQuestionValue;
                        $value->module_mast_id = $module_mast->id;
                        $value->com_id = $request->com_id;
                        $value->fy_id = $request->fy_id;
                        $value->ques_id = $val['ques_id'];
                        $value->value = isset($val['value']) ? $val['value'] : null;
                    $value->save();
                }

                foreach ($request->reputation as $val) {
                    $value = new TransitionQuestionValue;
                        $value->module_mast_id = $module_mast->id;
                        $value->com_id = $request->com_id;
                        $value->fy_id = $request->fy_id;
                        $value->ques_id = $val['ques_id'];
                        $value->value = isset($val['value']) ? $val['value'] : null;
                    $value->save();
                }

            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->route('user.transition.edit',encrypt($module_mast->id));
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
        $module_mast = ModuleMast::where('id', $id)->first();
        $transition_value = TransitionQuestionValue::where('module_mast_id', $id)->get();
        $transition_ques = DB::table('transition_question_master')->get();
        $sector = DB::table('sector_master')->where('id',Auth::user()->sector_id)->first();
        $fys = DB::table('fy_masters')->where('id',$module_mast->fy_id)->first();

        // dd($quesMast,$gov_value);
        return view('user.transition.edit', compact('module_mast','transition_value','fys','transition_ques','sector'));
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
                foreach ($request->policy as $val) {
                    $transition_data = TransitionQuestionValue::find($val['row_id']);
                        $transition_data->value = isset($val['value']) ? $val['value'] : null;
                        $transition_data->updated_at = Carbon::now();
                    $transition_data->save();
                }

                foreach ($request->tech as $val) {
                    $transition_data = TransitionQuestionValue::find($val['row_id']);
                        $transition_data->value = isset($val['value']) ? $val['value'] : null;
                        $transition_data->updated_at = Carbon::now();
                    $transition_data->save();
                }

                foreach ($request->market as $val) {
                    $transition_data = TransitionQuestionValue::find($val['row_id']);
                        $transition_data->value = isset($val['value']) ? $val['value'] : null;
                        $transition_data->updated_at = Carbon::now();
                    $transition_data->save();
                }

                foreach ($request->reputation as $val) {
                    $transition_data = TransitionQuestionValue::find($val['row_id']);
                        $transition_data->value = isset($val['value']) ? $val['value'] : null;
                        $transition_data->updated_at = Carbon::now();
                    $transition_data->save();
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
