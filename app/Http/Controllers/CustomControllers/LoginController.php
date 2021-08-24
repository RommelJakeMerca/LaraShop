<?php

namespace App\Http\Controllers\CustomControllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth; 
use App\Models\ClientUser;
use App\Models\RewardsModel;
use Session;
use DateTime;

class LoginController extends Controller
{   
    public function __construct()   {
        $this->middleware('preventBackHistory');
    }
    
    // show client login
    public function showClient_login() {
        return view('client_security.login');
    }

    // show client registration
    public function showClient_register() {
        return view('client_security.register');
    }

    // Google login 
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    // Google callback
    public function handleGoogleCallback()
    {
        date_default_timezone_set('Asia/Manila');
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);
        Session::flash('statuscode', 'success');
        $customerId = Auth::id();
        $rewardDatas= RewardsModel::all();
        foreach($rewardDatas as $rewardData) {
            if($customerId == $rewardData->user_id) {
                $rewardData->update_time = new DateTime();
                $rewardData->save();
                return redirect('shop_index')->with('status', 'Login Success!');
            }
        }
        return redirect('shop_index')->with('status', 'Login Success!');
    }

    // Facebook login 
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    // Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user);
        Session::flash('statuscode', 'success');
        return view('shop.shop_index')->with('status', 'Login Success!');
    }

    // function to know if user exists
    protected function _registerOrLoginUser($data) {
        date_default_timezone_set('Asia/Manila');
        $user = ClientUser::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new ClientUser();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->time_in = new DateTime();
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar; 
            $user->save();
        }
        $user->time_in = new DateTime();
        $user->save();
        Auth::login($user);
    }
}
