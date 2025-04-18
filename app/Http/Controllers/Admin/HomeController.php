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
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $user = Auth::user();

        $user_details = DB::table('users')
                                ->join('model_has_roles as mhr','mhr.model_id','users.id')
                                ->where('mhr.role_id',2)
                                // ->whereRaw('is_normal_user(id)=1')
                                ->where('created_by',$user->id)
                                ->orderby('id')->get();

        // Dashboard statistics
        $totalBanks = DB::table('users')->where('profileid', 2)->count();
        
        $activeBanksCount = DB::table('users')
            ->where('isactive', 'Y')
            ->where('profileid', 2)
            ->count();
            
        $publicSectorBanksCount = DB::table('users')
            ->where('bank_sector_type', 'public')
            ->where('profileid', 2)
            ->count();
            
        $privateSectorBanksCount = DB::table('users')
            ->where('bank_sector_type', 'private')
            ->where('profileid', 2)
            ->count();
            
        $totalCompanies = DB::table('users')->where('profileid', 4)->count();
        
        // Calculate percentages
        $publicPercentage = ($totalBanks > 0) ? round(($publicSectorBanksCount / $totalBanks) * 100) : 0;
        $privatePercentage = ($totalBanks > 0) ? round(($privateSectorBanksCount / $totalBanks) * 100) : 0;
        $activePercentage = ($totalBanks > 0) ? round(($activeBanksCount / $totalBanks) * 100) : 0;
        
        // Current date
        $currentDate = Carbon::now()->format('l, F d, Y');

        $mode = 'dark';
        $demo = 'modern';

        return view('admin.home', [
            'mode' => $mode, 
            'demo' => $demo,
            'user_details' => $user_details,
            'user' => $user,
            // Dashboard statistics
            'totalBanks' => $totalBanks,
            'activeBanksCount' => $activeBanksCount,
            'publicSectorBanksCount' => $publicSectorBanksCount,
            'privateSectorBanksCount' => $privateSectorBanksCount,
            'totalCompanies' => $totalCompanies,
            'publicPercentage' => $publicPercentage,
            'privatePercentage' => $privatePercentage,
            'activePercentage' => $activePercentage,
            'currentDate' => $currentDate
        ]);
    }
}
