<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class AjaxController extends Controller
{
    public function getSegments($data)
    {
        $prods = explode(',',$data);
        $segs = DB::table('eligible_products')->whereIn('id', $prods)->orderBy('target_segment')->select('target_segment')->distinct('target_segment')->pluck('target_segment')->toArray();
        //dd($segs);
        return json_encode($segs);
    }

    public function getCity($state)
    {
        $cities = DB::table('pincodes')->where('state', $state)->orderBy('city')->get()->unique('city')->pluck('city', 'city');
        return json_encode($cities);
    }


    public function getPincode($pincode)
    {
        // $city = new City;
        $state = DB::table('pincodes')->where('pincode',$pincode)->orderBy('pincode')->get()->pluck('state');
        if($state==null)
        {
            return false;
        }
        $city = DB::table('pincodes')->where('pincode',$pincode)->distinct('city')->pluck('city');
        // $district = DB::table('statedistrict')->where('state',$state[0])->pluck('district');
//
        $arr = array(
            'state' => $state,
            'city' => $city,
            // 'district' => $district,
        );
        // dd($pincodes);
        return json_encode($arr);
    }

    public function getPanCin($comp_name)
    {
        $pan = DB::table('company_cin_pan_master')->where('applicant_name', $comp_name)->get()->pluck('pan');
        $cin = DB::table('company_cin_pan_master')->where('applicant_name', $comp_name)->get()->pluck('cin');
        $tar_seg = DB::table('company_cin_pan_master')->where('applicant_name', $comp_name)->get()->pluck('target_segment');
        $pancin = array(
            'pan' => $pan,
            'cin' => $cin,
            'target_segment' => $tar_seg,
        );

        return json_encode($pancin);
    }


    public function getPin($pincode)
    {
        $user=Auth::user();
        // $zone_state=DB::table('zone_state_lat_long')->where('zone',$user->zone)->pluck('state');
        // dd($state);
        $state = DB::table('pincodes')->where('pincode',$pincode)->distinct('state')->pluck('state');

        // dd($state);

        $city = DB::table('pincodes')->where('pincode',$pincode)->distinct('city')->get()->pluck('city');
        // $district = DB::table('statedistrict')->where('state',$state)->distinct('district')->get()->pluck('district');
        // dd($city,$district);
            $arr = array(
                'state' => $state,
                'city' => $city,
                // 'district' =>$district,
        );

        return json_encode($arr);

    }


}
