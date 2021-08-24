<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DateTime;
use App\Models\ClientUser;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class ClientMiddleware
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
                if($currentUser->time_in > $beneficiary->created_at){
                    return redirect('shop_index');
                }
            }
            
            //FOR NEW USER ONLY AND TRY TO BYPASS THE BENEFICIARY FORM.
            $beneficiariesUserId = OrderModel::where('user_id', $customerId)->orderBy('created_at', 'desc')->limit(1)->get();
            if(count($beneficiariesUserId) == 0) {
                 return redirect('shop_index');
                 foreach ($beneficiariesUserId as $beneficiaryUserId) {
                    if($beneficiaryUserId->user_id != $customerId){
                        return redirect('shop_index');
                    }
                }
            } 
        }
        return $next($request);
    }
}
