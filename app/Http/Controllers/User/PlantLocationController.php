<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\AdditionalDetails;
use App\Models\PlantLocation;

class PlantLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        // $additional = AdditionalDetails::where('user_id', $user->id)->first();

        // if (isset($additional) && $additional->status == 'D') {
        //     return redirect()->route('user.additional_details.edit', $user->id);
        // }

        return view('user.plantlocation.create', compact('user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // try
        // {
        $user = User::find(Auth::user()->id);

        DB::transaction(function () use ($request, $user) {

            $user->co_off_add = $request->co_off_add;
            $user->co_off_pin = $request->co_off_pin;
            $user->co_off_state = $request->co_off_state;
            $user->co_off_city = $request->co_off_city;
            $user->plant_flag = $request->plant_flag;
            $user->save();

            if ($request->plant_flag == 'Y')
            {
                foreach ($request->plant as $key => $value)
                {
                    $plnt_loc = new PlantLocation;
                        $plnt_loc->user_id = $request->user_id;
                        $plnt_loc->plnt_address = $value['plnt_address'];
                        $plnt_loc->plnt_pincode = $value['plnt_pincode'];
                        $plnt_loc->plnt_state = $value['plnt_state'];
                        $plnt_loc->plnt_city = $value['plnt_city'];
                        $plnt_loc->status = 'D';
                    $plnt_loc->save();
                }
            }


        });
        alert()->success('Data Stored', 'Success!')->persistent('Close');
        // return redirect()->back();
        return redirect()->route('user.plant.edit', $request->user_id);

        // } catch (\Exception $e)
        // {
        //     errorMail($e, $request->app_id, Auth::user()->id);
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
    public function edit($user_id)
    {
        // dd($user_id);
        $user = Auth::user();
        $plantlocation = PlantLocation::where('user_id', $user_id)->get();
        // dd($user_id, $additional,$plantlocation);

        return view('user.plantlocation.edit', compact('user', 'plantlocation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request, $id);

        // try {
            $user = User::find(Auth::user()->id);

            DB::transaction(function () use ($request, $user) {

                $user->co_off_add = $request->co_off_add;
                $user->co_off_pin = $request->co_off_pin;
                $user->co_off_state = $request->co_off_state;
                $user->co_off_city = $request->co_off_city;
                $user->plant_flag = isset($request->plant_flag) ? $request->plant_flag : null;
                $user->save();

                if ($request->plant_flag == 'Y') {
                    foreach ($request->plant as $key => $value) {
                        // dd($value);
                        if (array_key_exists('row_id', $value)) {
                            $plnt_loc = PlantLocation::find($value['row_id']);
                            $plnt_loc->plnt_address = $value['plnt_address'];
                            $plnt_loc->plnt_pincode = $value['plnt_pincode'];
                            $plnt_loc->plnt_state = $value['plnt_state'];
                            $plnt_loc->plnt_city = $value['plnt_city'];
                            $plnt_loc->save();
                        } else {
                            $plnt_loc = new PlantLocation;
                            $plnt_loc->user_id = $request->user_id;
                            $plnt_loc->plnt_address = $value['plnt_address'];
                            $plnt_loc->plnt_pincode = $value['plnt_pincode'];
                            $plnt_loc->plnt_state = $value['plnt_state'];
                            $plnt_loc->plnt_city = $value['plnt_city'];
                            $plnt_loc->status = 'D';
                            $plnt_loc->save();
                        }

                    }
                } else {
                    foreach ($request->plant as $key => $value) {
                        $plnt_loc = PlantLocation::find($value['row_id']);
                        if ($plnt_loc) {
                            $plnt_loc->delete();
                        }
                    }
                }

            });
            alert()->success('Data Updated', 'Success!')->persistent('Close');
            // return redirect()->route('user.edit_application',$request->id);
            return redirect()->back();
        // } catch (\Exception $e) {
        //     // errorMail($e, $request->app_id, Auth::user()->id);
        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($row_id)
    {
        if ($row_id == Null) {
            return false;
        } else {
            $shareholding = PlantLocation::where('id', $row_id)->delete();
            return true;
        }
    }
}
