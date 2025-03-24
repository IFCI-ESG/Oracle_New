<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeqQuestionValue;
use App\Models\ModuleMast;
use App\Models\User;
use App\Models\DocumentUploads;
use App\Models\DocumentMaster;
use Auth;
use DB;
use Carbon\Carbon;

class SEQController extends Controller
{
    // seq_question_value
    // seq_mast
    // seq_question_master
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $fys = DB::table('fy_masters')->where('status', '1')->orderby('start_date','desc')->get();

        $seq_value = SeqQuestionValue::where('com_id', $user->id)->orderby('id')->get();

        $module_mast = ModuleMast::where('com_id', $user->id)->where('module_type', 'SEQ')->orderby('id')->get();
        // dd($module_mast);

        return view('user.seq.index', compact('user','fys','seq_value','module_mast'));

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

        $module_mast = ModuleMast::where('com_id', $user->id)->where('fy_id',$fy_id)->first();

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();

        return view('user.seq.create', compact('user','fys','fy_id','module_mast'));
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
        try {
            $module_mast = ModuleMast::where('com_id',$request->com_id)->where('fy_id',$request->fy_id)->first();

            $module_mast = new ModuleMast;
                $module_mast->com_id = $request->com_id;
                $module_mast->status = 'D';
                $module_mast->fy_id = $request->fy_id;
                $module_mast->module_type = 'SEQ';

            DB::transaction(function () use ($request,$module_mast)
            {
                $module_mast->save();

                if($request->seq_type=='individual')
                {
                    foreach ($request->individual as $val) {
                        $seq_data = new SeqQuestionValue;
                            $seq_data->module_mast_id = $module_mast->id;
                            $seq_data->com_id = $request->com_id;
                            $seq_data->fy_id = $request->fy_id;
                            $seq_data->seq_type = $request->seq_type;
                            $seq_data->species = isset($val['species']) ? $val['species'] : null;
                            $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                            $seq_data->height = isset($val['height']) ? $val['height'] : null;
                            $seq_data->density = isset($val['density']) ? $val['density'] : null;
                        $seq_data->save();
                    }
                }elseif($request->seq_type=='multiple')
                {
                    foreach ($request->multiple as $val) {
                        $seq_data = new SeqQuestionValue;
                            $seq_data->module_mast_id = $module_mast->id;
                            $seq_data->com_id = $request->com_id;
                            $seq_data->fy_id = $request->fy_id;
                            $seq_data->seq_type = $request->seq_type;
                            $seq_data->species = isset($val['species']) ? $val['species'] : null;
                            $seq_data->no_of_trees = isset($val['no_of_trees']) ? $val['no_of_trees'] : null;
                            $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                            $seq_data->height = isset($val['height']) ? $val['height'] : null;
                            $seq_data->density = isset($val['density']) ? $val['density'] : null;
                        $seq_data->save();
                    }
                }elseif($request->seq_type=='area')
                {
                    foreach ($request->area as $val) {
                        $seq_data = new SeqQuestionValue;
                            $seq_data->module_mast_id = $module_mast->id;
                            $seq_data->com_id = $request->com_id;
                            $seq_data->fy_id = $request->fy_id;
                            $seq_data->seq_type = $request->seq_type;
                            $seq_data->sample_area = $request->sample_area;
                            $seq_data->total_area = $request->total_area;
                            $seq_data->species = isset($val['species']) ? $val['species'] : null;
                            $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                            $seq_data->height = isset($val['height']) ? $val['height'] : null;
                            $seq_data->density = isset($val['density']) ? $val['density'] : null;
                            $seq_data->sample_area = isset($val['sample_area']) ? $val['sample_area'] : null;
                            $seq_data->total_area = isset($val['total_area']) ? $val['total_area'] : null;
                        $seq_data->save();
                    }
                }


            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->route('user.seq.edit',encrypt($module_mast->id));
            // return redirect()->route('user.addquestionnaire');
        } catch (\Exception $e) {

            dd( $e->getMessage());
            alert()->warning('Something Went Wrong', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
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
        $seq_value = SeqQuestionValue::where('module_mast_id', $id)->get();
        $fys = DB::table('fy_masters')->where('id',$module_mast->fy_id)->first();

        // dd($seq_value);
        return view('user.seq.edit', compact('module_mast','seq_value','fys'));
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
        try{

            DB::transaction(function () use ($request)
            {
                $module_mast = ModuleMast::where('id', $request->module_mast_id)->first();
                $seq_value = SeqQuestionValue::where('module_mast_id', $request->module_mast_id)->first();
                    // dd($seq_value);

                if($request->seq_type == $seq_value->seq_type)
                {
                    if($request->seq_type=='individual')
                    {
                        foreach ($request->individual as $val) {
                            if(isset($val['row_id']))
                            {
                                $seq_data = SeqQuestionValue::find($val['row_id']);
                                    $seq_data->species = isset($val['species']) ? $val['species'] : null;
                                    $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                                    $seq_data->height = isset($val['height']) ? $val['height'] : null;
                                    $seq_data->density = isset($val['density']) ? $val['density'] : null;
                                    $seq_data->updated_at = Carbon::now();
                                $seq_data->save();
                            }
                        }
                    }elseif($request->seq_type=='multiple')
                    {
                        foreach ($request->multiple as $val) {
                            if(isset($val['row_id']))
                            {
                                $seq_data = SeqQuestionValue::find($val['row_id']);
                                    $seq_data->species = isset($val['species']) ? $val['species'] : null;
                                    $seq_data->no_of_trees = isset($val['no_of_trees']) ? $val['no_of_trees'] : null;
                                    $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                                    $seq_data->height = isset($val['height']) ? $val['height'] : null;
                                    $seq_data->density = isset($val['density']) ? $val['density'] : null;
                                    $seq_data->updated_at = Carbon::now();
                                $seq_data->save();
                            }
                        }
                    }elseif($request->seq_type=='area')
                    {
                        foreach ($request->area as $val) {
                            if(isset($val['row_id']))
                            {
                                $seq_data = SeqQuestionValue::find($val['row_id']);
                                    $seq_data->sample_area = $request->sample_area;
                                    $seq_data->total_area = $request->total_area;
                                    $seq_data->species = isset($val['species']) ? $val['species'] : null;
                                    $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                                    $seq_data->height = isset($val['height']) ? $val['height'] : null;
                                    $seq_data->density = isset($val['density']) ? $val['density'] : null;
                                    $seq_data->sample_area = isset($val['sample_area']) ? $val['sample_area'] : null;
                                    $seq_data->total_area = isset($val['total_area']) ? $val['total_area'] : null;
                                    $seq_data->updated_at = Carbon::now();
                                $seq_data->save();
                            }
                        }
                    }
                }else{

                    SeqQuestionValue::where('module_mast_id', $request->module_mast_id)->delete();

                    if($request->seq_type=='individual')
                    {
                        foreach ($request->individual as $val) {
                            $seq_data = new SeqQuestionValue;
                                $seq_data->module_mast_id = $module_mast->id;
                                $seq_data->com_id = $module_mast->com_id;
                                $seq_data->fy_id = $module_mast->fy_id;
                                $seq_data->seq_type = $request->seq_type;
                                $seq_data->species = isset($val['species']) ? $val['species'] : null;
                                $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                                $seq_data->height = isset($val['height']) ? $val['height'] : null;
                                $seq_data->density = isset($val['density']) ? $val['density'] : null;
                            $seq_data->save();
                        }
                    }elseif($request->seq_type=='multiple')
                    {
                        foreach ($request->multiple as $val) {
                            $seq_data = new SeqQuestionValue;
                                $seq_data->module_mast_id = $module_mast->id;
                                $seq_data->com_id = $module_mast->com_id;
                                $seq_data->fy_id = $module_mast->fy_id;
                                $seq_data->seq_type = $request->seq_type;
                                $seq_data->species = isset($val['species']) ? $val['species'] : null;
                                $seq_data->no_of_trees = isset($val['no_of_trees']) ? $val['no_of_trees'] : null;
                                $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                                $seq_data->height = isset($val['height']) ? $val['height'] : null;
                                $seq_data->density = isset($val['density']) ? $val['density'] : null;
                            $seq_data->save();
                        }
                    }elseif($request->seq_type=='area')
                    {
                        foreach ($request->area as $val) {
                            $seq_data = new SeqQuestionValue;
                                $seq_data->module_mast_id = $module_mast->id;
                                $seq_data->com_id = $module_mast->com_id;
                                $seq_data->fy_id = $module_mast->fy_id;
                                $seq_data->seq_type = $request->seq_type;
                                $seq_data->sample_area = $request->sample_area;
                                $seq_data->total_area = $request->total_area;
                                $seq_data->species = isset($val['species']) ? $val['species'] : null;
                                $seq_data->gbh = isset($val['gbh']) ? $val['gbh'] : null;
                                $seq_data->height = isset($val['height']) ? $val['height'] : null;
                                $seq_data->density = isset($val['density']) ? $val['density'] : null;
                                $seq_data->sample_area = isset($val['sample_area']) ? $val['sample_area'] : null;
                                $seq_data->total_area = isset($val['total_area']) ? $val['total_area'] : null;
                            $seq_data->save();
                        }
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

    public function destroy($row_id)
    {
        if ($row_id == Null) {
            return false;
        } else {
            $shareholding = SeqQuestionValue::where('id', $row_id)->delete();
            return true;
        }
    }

}
