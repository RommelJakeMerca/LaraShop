<?php

namespace App\Http\Controllers\CustomControllers;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\ClientOrderModel;
use DateTime;



class CartController extends Controller
{

    public function  addToCart(Request $request) {
        date_default_timezone_set('Asia/Manila');

        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalProductPrice = $request['product_quantity'] * $request['product_price'];

        if($customerId) {
            $cartData = array(                 
                'user_id' => $customerId,
                'product_id' => $request['product_id'],
                'product_image' => $request['product_image'],
                'product_name' => $request['product_name'],
                'product_quantity' => $request['product_quantity'],
                'product_price' =>  $totalProductPrice,
                'product_current_price' => $request['product_price'],
                'cart_created_at' => new DateTime(),
                'cart_status' => 'unpaid',
            );  
           $cartModels =  CartModel::updateOrCreate(['user_id' => $customerId, 'cart_status' => 'unpaid', 'product_id' => $request['product_id']], $cartData);
            return response()->json($cartData);
        } else {
            return redirect('client_login');
        }

    }
  
    public function showCart(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->orderBy('cart_created_at', 'desc')->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        if($request->ajax()) {
            $output="";
            $outputTotalPrice="";
            $outputTotalQuantity=""; 
            if(count($cartTables) > 0) {
                foreach($cartTables as $cartTable) {
                    $output.="<li><img  class='sidebar-cart-img' src='/uploads/product_images/$cartTable->product_image'>".
                    "<p class='sidebar-cart-name' id='sidebar-cart-name'>".$cartTable->product_name."</p>".
                    "<p class='sidebar-cart-quantity'>X"."<b>".$cartTable->product_quantity."</b></p>".
                    "<p class='sidebar-cart-price'>"."<b>₱".$cartTable->product_price.".00"."</b></p></li>";
                }
                $outputTotalPrice.="CART TOTAL:<b id='cart-total-price'>".$totalPrice."</b><b>&#8369;</b>";
                $outputTotalQuantity.= $totalQuantity;

                return response()->json([$output, $outputTotalPrice, $outputTotalQuantity]);
            }
        }
    }

    public function updateShoppingCart(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $totalProductPrice = $request['product_quantity'] * $request['product_current_price'];
        
        if(count($cartTables) > 0 ) {
           $updateCart = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid, 'product_id' => $request['product_id']])
            ->update(['product_quantity' => $request['product_quantity'], 'product_price' => $totalProductPrice]); 
            return response()->json($updateCart);
        }
    }

    public function deleteShoppingCart(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
   
        if(count($cartTables) > 0 ) {
            $deleteCart = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid, 'product_id' => $request['product_id']])->delete();
            return response()->json($deleteCart); 
        }
    }

    public function showExistingShoppingCart(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $vat = 0.12;
        $vatValue = $totalPrice * $vat;
       

        if($request->ajax()) {
            $outputExistingProducts="";
            $outputEmptyProducts="";
            $outputTotalPrice="";
            $outputTotalQuantity="";
            $outputRewardPoints="";
            $outputVatValue="";
            if(count($cartTables) > 0) {
                foreach($cartTables as $cartTable) {
                    $outputExistingProducts.="<tr class='cartpage'>".
                    "<td><img src='/uploads/product_images/$cartTable->product_image'></td>".
                    "<td class='alignment'>".$cartTable->product_name.
                    "<br><b style='font-size:12px;'>&#8369;".$cartTable->product_current_price.'.00</b></td>'.
                    "<td class='alignment'><input type='text' name='product_quantity' id='product_quantity' 
                    class='td-product-quantity' value='$cartTable->product_quantity' maxlength='2'></td>".
                    "<td class='alignment'><p class='td-price'>&#8369;<b class='price-value'>".
                    $cartTable->product_price."</b></p></td>".
                    "<td class='alignment'><button id='delete_product' class='delete-product'>
                    <i class='fas fa-minus-circle'></i></button></td>".
                    "<td id='td-product-price'><input type='hidden' name='product_current_price' 
                    value='$cartTable->product_current_price' class='product-current-price'></td>".
                    "<td id='td-product-id'><input type='hidden' name='product_id' 
                    value='$cartTable->product_id' class='product-id'></td>".
                    "</tr>";
                }

                if($totalQuantity > 0) { $outputTotalQuantity.= $totalQuantity; }
                $totalPrice > 0 ? $outputRewardPoints .= floor($totalPrice / 1000) : $outputRewardPoints .= 0;
                $outputTotalPrice.= $totalPrice;
                $outputVatValue .= $vatValue;

                return response()->json([
                        $outputExistingProducts,
                        $outputEmptyProducts,
                        $outputTotalQuantity,
                        $outputTotalPrice,
                        $outputRewardPoints,
                        $outputVatValue
                    ]);
            } 
            else {
                if($totalQuantity == 0 ){ $outputTotalQuantity.= 0; }
                $outputTotalPrice.= 0;
                $outputVatValue .= 0;
                $outputEmptyProducts.="<center><img class='td-empty-cart' src='/products_asset/images/error/empty-cart.png'></center>
                <p class='td-shopping-cart'>YOUR SHOPPING CART IS EMPTY</i></p>";
                return response()->json([
                    $outputExistingProducts,
                    $outputEmptyProducts,
                    $outputTotalQuantity,
                    $outputTotalPrice,
                    $outputRewardPoints,
                    $outputVatValue
                ]);
            }
        }
    }
}