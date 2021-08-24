<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Sentinel;
use Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Sentinel::check()) {
            $roles = Sentinel::getUser()->roles;
            foreach($roles as $role) {
                if($role->name == 'SuperAdmin') {
                    return $next($request);
                }else {
                    Sentinel::logout();
                    Session::flash('statuscode', 'warning');
                    return redirect('sentinel_login')->with(['status' => "You are Logged out, Please contact your administrator first, to gain Admin Access."]);
                }
            }
        }else {
            return redirect ('/');
        }
    }
}
