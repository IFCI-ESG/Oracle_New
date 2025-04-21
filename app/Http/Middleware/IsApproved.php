<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsApproved
{
    public function handle($request, Closure $next)
    {


        $isApproved = Auth::user()->isactive;

         if($isApproved <> 'Y')
        {
            return redirect('/verifyuser');
        }
        return $next($request);
    }
}
