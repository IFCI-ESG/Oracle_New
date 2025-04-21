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
use App\Models\ModuleMast;
use App\Models\PlantLocation;
use App\Models\PhysicalValue;
use Auth;
use DB;
use Carbon\Carbon;

class PhysicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fys = DB::table('fy_masters')->orderby('id','desc')->get();

        $module_mast = ModuleMast::where('module_type', 'Physical_Risk')->where('com_id', Auth::user()->id)->get();
        $physical_value = PhysicalValue::where('com_id', Auth::user()->id)->orderby('id')->get();

        return view('user.physical.index', compact('fys','physical_value','module_mast'));

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

        $module_mast = ModuleMast::where('module_type', 'Physical_Risk')->where('com_id', Auth::user()->id)->where('fy_id',$fy_id)->first();

        $plantlocation = PlantLocation::where('user_id', Auth::user()->id)->orderby('id')->get();

        $fys = DB::table('fy_masters')->where('id',$fy_id)->first();
        $sector = DB::table('sector_master')->where('id',Auth::user()->sector_id)->first();
        $physical_img = DB::table('physical_risk_img')->get();

        return view('user.physical.create', compact('plantlocation','fys','fy_id','module_mast','sector','physical_img'));
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
            $request->validate([
                'plant.*.risk' => 'required|array', // Must be an array of IDs
            ]);

            $module_mast = new ModuleMast;
                $module_mast->com_id = $request->com_id;
                $module_mast->status = 'D';
                $module_mast->fy_id = $request->fy_id;
                $module_mast->module_type = 'Physical_Risk';

            DB::transaction(function () use ($request,$module_mast)
            {
                $module_mast->save();
                // dd($request->plant);
                $plt=[];
                foreach ($request->plant as $val) {
                    $plt_temp = array($val['plant_id']=>$val['risk']);
                    $plt = $plt + $plt_temp;
                }
                    $phy = new PhysicalValue;
                        $phy->com_id = $request->com_id;
                        $phy->module_mast_id = $module_mast->id;
                        $phy->fy_id = $request->fy_id;
                        $phy->plant_and_risk_id = json_encode($plt);
                    $phy->save();

            });
            alert()->success('Record Inserted', 'Success!')->persistent('Close');
            return redirect()->route('user.physical.edit',encrypt($module_mast->id));
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
        $fys = DB::table('fy_masters')->where('id',$module_mast->fy_id)->first();
        $sector = DB::table('sector_master')->where('id',Auth::user()->sector_id)->first();
        $physical_img = DB::table('physical_risk_img')->get();

        $plantlocation = PlantLocation::where('user_id', $module_mast->com_id)->orderby('id')->get();
        $physical_values = PhysicalValue::where('com_id', $module_mast->com_id)->where('module_mast_id', $module_mast->id)->where('fy_id', $module_mast->fy_id)->first();

        $img_ids = [];

        // foreach ($physical_values as $physical_value) {
            $img_ids = array_merge($img_ids, json_decode($physical_values->plant_and_risk_id, true));
        // }
        // dd($img_ids);

        // Optionally remove duplicate IDs
        // $img_ids = array_unique($img_ids);
        // dd($physical_values,$img_ids,$physical_img);

        return view('user.physical.edit', compact('module_mast','plantlocation','sector','physical_img','physical_values','fys','img_ids'));
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

                $physical_data = PhysicalValue::find($request->row_id);
                    $physical_data->img_id = json_encode($request->img_selection);
                    $physical_data->updated_at = Carbon::now();
                $physical_data->save();

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
