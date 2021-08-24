<?php

namespace App\Http\Middleware;

use Auth;
use DateTime;
use DateInterval;
use Closure;
use App\Models\CartModel;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class ThankyouMiddleware
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
        date_default_timezone_set('Asia/Manila');
        $customerId = Auth::id();
        $paid = 'paid';
        $productDates = CartModel::where(['user_id' => $customerId, 'cart_status' => $paid])->get()->last();

        if($productDates == null) {
            return redirect('products/store');
        } 

        if($productDates != null){
            $updated_at = $productDates->updated_at->sub(new DateInterval('PT10S'));
            $paidProductIds = CartModel::where(['user_id' => $customerId, 'cart_status' => $paid])
            ->where('updated_at', '>=', $updated_at)->get()->last();
            $updatedAtValidates = $paidProductIds->updated_at->add(new DateInterval('PT30S'));
            $dateValidates = new DateTime();

            if($updatedAtValidates < $dateValidates) {
                return redirect('products/store');
            }
        }
        
        return $next($request);
    }
}
