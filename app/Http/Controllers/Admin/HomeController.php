<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\ModelHasRoles;
use GuzzleHttp\Client;
use Auth;
use Alert;



class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        //$arr_financial_year=getFinancialYear();
        //dd($arr_financial_year['sort_year']);
        $user = Auth::user();

        $user_details = DB::table('admin_users')
                                ->join('model_has_roles as mhr','mhr.model_id','admin_users.id')
                                ->where('mhr.role_id',2)
                                // ->whereRaw('is_normal_user(id)=1')
                                ->where('created_by',$user->id)
                                ->orderby('id')->get();


            // dd($user,$user_details);

           $mode='dark';
            $demo='modern';

        return view('admin.home', ['mode' => $mode, 'demo' => $demo,'user_details'=>$user_details,'user'=>$user]);
    }



}
