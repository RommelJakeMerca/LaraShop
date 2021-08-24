<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\ClientUser;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class BeneficiaryMiddleware
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
        if(Auth::id()){
            $customerId = Auth::id();
            $currentUser = ClientUser::where('id', $customerId)->first();
            $beneficiaries = OrderModel::where('user_id', $customerId)->orderBy('created_at', 'desc')->limit(1)->get();
            foreach ($beneficiaries as $beneficiary) { 
                if($beneficiary->created_at > $currentUser->time_in) {
                    return redirect('products/store');
                }
            }
        }
        return $next($request);
    }
}
