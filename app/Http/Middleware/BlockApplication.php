<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;

class BlockApplication
{
    // To block Application Editing and Submission after a certain date
    public function handle($request, Closure $next)
    {
        
            $checkDate = Carbon::parse('2023-03-18 23:59:00');
           // dd(Carbon::now()->gt($checkDate));
            if(Carbon::now()->gt($checkDate))
            {
                if(isset(Auth::user()->id))
                {
                    alert()->error('Application Window closed!', 'Info')->persistent('Close');
                    return redirect()->route('applications.index');
                }
                else{
                    return redirect('/');
                }    
            }
            else
            {
                return $next($request);
            }
      

    }
}