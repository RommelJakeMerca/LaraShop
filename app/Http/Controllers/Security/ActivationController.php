<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Sentinel;
use Activation;
use App\Models\User;
use Session;

class ActivationController extends Controller
{
    //function for user email activation
    public function activate($email, $code) {
        //pass the user id to variable
        $user = User::whereEmail($email)->first();
        $userID = $user->id;
        $user = Sentinel::findById($userID);

        // condition if the user is already activated prompt to login page
        if(Activation::complete($user, $code)){
            Session::flash('statuscode', 'success');
            return redirect('sentinel_login')->with(['status' => "Account Verified! You may now login to your account"]);
        }
        
    }
}
