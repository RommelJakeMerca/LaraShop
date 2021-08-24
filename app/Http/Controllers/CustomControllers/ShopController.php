<?php

namespace App\Http\Controllers\CustomControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\OrderModel;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth; 
use Session;
use App\Models\ClientUser;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('preventBackHistory');
        $this->middleware('beneficiary', 
        [
            'only' => 
            [
                'show_shop_index',
                'show_beneficiary_info_form'
            ]
        ]);
    }

    // function to show Shop index 
    public function show_shop_index() {
        $customerId = Auth::id();
        $currentUsers = ClientUser::where('id', $customerId)->first();
        return view('shop.shop_index',[
            'currentUsers' => $currentUsers
        ]);
    }

    // function to show pickup store branch
    public function show_pickup_store() {
        return view('shop.regions_stores');
    }

    // function to show Pickup Benificiary info form
    public function show_beneficiary_info_form(Request $request, $id) {
        $currentUser = ClientUser::all()->where('id', '==', $id)->first();
        if(!$currentUser) {
            return redirect('shop_index');
        } else {
            return view('shop.beneficiary_info')->with('currentUser', $currentUser);
        }
    }

    // function for inserting order info to databases
    public function insert_order_info(Request $request) {
        date_default_timezone_set('Asia/Manila');
        $infoOrder = new OrderModel; 
        $user = Auth::id();
        $infoOrder->user_id = $user;
        $infoOrder->beneficiary_name = $request->input('beneficiary_name');
        $infoOrder->relationship = $request->input('relationship');
        $infoOrder->email = $request->input('email');
        $infoOrder->phone_number = $request->input('phone_number');
        $infoOrder->region_chosen = $request->input('region_chosen');
        $infoOrder->province = $request->input('province');
        $infoOrder->city = $request->input('city');
        $infoOrder->selected_store = $request->input('selected_store');
        $infoOrder->selected_branch = $request->input('selected_branch');
        $infoOrder->time_of_pickup = $request->input('time_of_pickup');
        $infoOrder->message = $request->input('message');
        $currentUser = ClientUser::all()->where('id', '==', $user)->first();
        $infoOrder->save();

        Session::flash('statuscode', 'success');
        return redirect('/products/store')->with('currentUser', $currentUser)
                                          ->with('status', 'Thank you! You can shop now.');
    }

    // function to show Products index 
    public function show_checkout() {
        $info = OrderModel::all()->last();
        return view('products.checkout')->with('info', $info);
    }
}
