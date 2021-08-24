<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Models\CartModel;

class CartMiddleware
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
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');

        if($totalPrice < 500) {
            return redirect('products/shopping-cart');
        }

        return $next($request);
    }
}
