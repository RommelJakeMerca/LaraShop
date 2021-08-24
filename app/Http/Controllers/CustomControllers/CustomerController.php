<?php

namespace App\Http\Controllers\CustomControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientUser;
use App\Models\CartModel;
use App\Models\ClientOrderModel;
use App\Models\RewardsModel;
use Session;
use Auth;
use Validator;
use DateTime; 
use DateInterval;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('preventBackHistory');
    }
    
    //TO SHOW PROFILE SETTINGS PANEL
    public function profileSettings() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->firstOrFail();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products.profile_settings',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //UPDATE PROFILE SETTINGS PANEL 
    public function updateCustomer(Request $request) {
        $request->validate([
            'name' => 'required|min:4|string|max:255',
            'address' => 'required',
            'contact_number' => ['required', 'max:11', 'regex:/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/'],
            'g-recaptcha-response' => 'required|captcha'
        ]);
        
        $customerId = Auth::id();
        $customerUpdate = ClientUser::where('id', $customerId)->first();
        $customerUpdate->name = $request['name'];
        $customerUpdate->gender = $request['gender'];
        $customerUpdate->address = $request['address'];
        $customerUpdate->contact_number = $request['contact_number'];
        $customerUpdate->save();
        return redirect('customer/profile-settings')->with('success', 'Profile Successfully Updated');
    }

    //TO SHOW REWARDS PANEL
    public function rewards(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->firstOrFail();
        $rewardDatas= RewardsModel::where('user_id', $customerId)->get();
        $rewardPaginates = RewardsModel::where('user_id', $customerId)->paginate(10);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        
        $addReward = array();
        for ($i = 0; $i < count($rewardDatas); $i++) { 
            $addReward[] = $rewardDatas[$i]['reward_points'];
        }
        $addReward = str_replace(" POINTS","",$addReward);
        $currentValue = array_sum($addReward);

        return view('products.rewards', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'rewardDatas' => $rewardDatas,
            'currentValue' => $currentValue,
            'rewardPaginates' => $rewardPaginates,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //TO SHOW TRANSACTION HISTORY PANEL
    public function transactionHistory() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->firstOrFail();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
    
        return view('products.transaction',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //TO SHOW TRANSACTION HISTORY DETAILS
    public function transactionDetails() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->firstOrFail();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products.transaction_details',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //CLIENT LOGIN
    public function clientLogin() { 
        return view('client_security.login');
    }

    //CLIENT LOG OUT
    public function clientLogout() {
        Auth::logout();
        Session::flash('statuscode', 'success');
        return redirect('products/store')->with(['status' => "Logged out, See you!"]);
    }
}
