<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UnsdgValue;
use DB;
use Auth;
use App\User;

class UnsdgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        dd($request);
        $claimMast = ClaimMast::where('id', $request->claim_id)->first();
        $user = Auth::user();

        $appMast = ApplicationMast::where('created_by', '=', $user->id)->first();

        try {
            DB::transaction(function () use ($request, $claimMast, $appMast) {

                foreach ($request->investment as $value)
                {
                    if(isset($value['row_id']))
                    {
                        $invest = ClaimS4SalesInvest::find($value['row_id']);
                            $invest->invest_response = $value['response'];
                            $invest->updated_at=carbon::now();
                        $invest->save();
                    }
                }

            });
            alert()->success('Record Updated', 'Success!')->persistent('Close');
            return redirect()->back();
        } catch (\Exception $e) {
           alert()->Warning('Data incorrect', 'Warning!')->persistent('Close');
            return redirect()->back();
        }
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
