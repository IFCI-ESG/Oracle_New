<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\User;
use App\AdminAudit;
use Mail;
use Illuminate\Support\Facades\Hash;

class LoginIDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_list =DB::table('users as u')->join('model_has_roles as mhr','u.id','=','mhr.model_id')
                                            ->whereIn('mhr.role_id',['2','8'])
                                            ->get(); 

        return view('admin.login',compact('admin_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role =DB::Table('roles')->whereIn('id',['2','8'])->get();

        return view('admin.login_create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $email = User::where('email',$request->email_id)->first();
        $mobile = User::where('mobile',$request->mobile)->first();

        if($email || $mobile){
            alert()->error('Email or Mobile Number must be unique', 'Attention!')->persistent('Close');
            return redirect()->route('admin.login.create');
                    
        }

        DB::transaction(function () use ($request) {
            
            $user = User::create([
                'name'=>strtoupper($request->name),
                'email'=>$request->email_id,
                'mobile'=>$request->mobile,
                'email_verified_at'=>Carbon::now(),
                'mobile_verified_at'=>Carbon::now(),
                'password'=>Hash::make($request->password),
                'isapproved'=>'Y',
            ]);

            DB::insert('insert into model_has_roles values(?,?,?)',[$request->user_type,'App\User',$user->id]);

            $user = array('name' => strtoupper($request->name), 'email' => $request->email_id,'password'=>$request->password);

            Mail::send('emails.email_credentials', $user, function ($message) use ($user) {
                $message->to($user['email'])->subject('Your credentials for SPECS portal');
                // $message->cc('specs@ifciltd.com');
            });

        });

        return redirect()->route('admin.create_id');
      
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
     * Show the form for editing the speci.fied resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $role =DB::Table('model_has_roles')->where('model_id',$id)->Orderby('role_id','desc')->first();
       $login = User::where('id',$id)->get();
       return view('admin.login_edit',compact('login','role','id'));
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
        DB::transaction(function () use ($request, $id) {
            $user = User::find($id);
            $admin = new AdminAudit;
            
            $admin->user_id = $user->id;
            $admin->name = $user->name;
            $admin->email = $user->email;
            $admin->mobile = $user->mobile;
                $admin->role_id = ($user->hasRole('Admin')) ? 2 : 8;
                $admin->isactive = $user->isapproved;
                $admin->admin_created_by = Auth::user()->id;
                $admin->admin_created_at = Carbon::now();
                $admin->operation = "UPDATE";
                $admin->save();

            $user->email = $request->email_id;
            $user->email_verified_at = null;
            $user->mobile = $request->mobile;
            $user->mobile_verified_at = null;
        $user->save();
        
        if($request->user_type=='2'){
            $user->removeRole('ViewOnlyUser');
            $user->assignRole('Admin');
        }if($request->user_type=='8'){
            $user->removeRole('Admin');
            $user->assignRole('ViewOnlyUser');
        }
        
        alert()->success('Admin List Data Updated', 'Success')->persistent('Close');

        });
     return redirect()->route('admin.create_id');
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

    public function update_status($status,$id)
    {
        DB::transaction(function () use ($status, $id) {
        $user = User::find($id);
        $user->isapproved= ($status == 'Y') ? 'N' : 'Y';
        $user->save();
        
        $admin = new AdminAudit;
            $admin->user_id = $user->id;
            $admin->name = $user->name;
            $admin->email = $user->email;
            $admin->mobile = $user->mobile;
            $admin->role_id = ($user->hasRole('Admin')) ? 2 : 8;
            $admin->isactive = ($status == 'Y') ? 'Y' : 'N';
            $admin->admin_created_by = Auth::user()->id;
            $admin->admin_created_at = Carbon::now();
            $admin->operation = "STATUS UPDATE";
        $admin->save();

        $val = ($status == 'Y') ? 'Deactive' : 'Active';

        alert()->success('ID has been '.$val.' successfully', 'Success!')->persistent('Close');
        });

        return redirect()->route('admin.create_id');
    }
}

  
