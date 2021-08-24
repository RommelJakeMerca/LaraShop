<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Sentinel;
use Activation;
use Validator;
use App\Models\User;
use App\Models\Roles\RoleModel;
use Mail;
use Session;

class RegisterController extends Controller
{
    // to show sentinel registration - admin
    public function admin_reg() {
        $data['roles'] = RoleModel::get();
        return view('security.admin_reglog')->with('data', $data);
    }

    // Registration Action
    public function admin_register(Request $request) {
        $this->validate($request, [
            'username' => 'required|max:50',
            'email' => 'unique:users|required|email',
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirmation' => 'required|min:7|max:12'
        ]);
       
        $data = $request->all();
        $roleID = 1000;

        $user = Sentinel::register($request->all());
 
        $role = Sentinel::findRoleByID($roleID);
        $role->users()->attach($user);
        
        $activate = Activation::create($user);
        $this->sendActivationEmail($user, $activate->code);
        $returnData = array(
            'status' => 'success',
            'message' => 'Verify your account first',
            'errors' => ["Please activate your account first"]
        );
        Session::flash('statuscode', 'success');
        return redirect()->back()->with(['status' => "Registered Successfully! Verify your email to login."]);
    }
    
    //function for sending Activation email for the user to activate his/her account
    public function sendActivationEmail($user, $code) {
        Mail::send(
            'email.activation',
            ['user' => $user, 'code' => $code],
            function($message) use ($user){
                $message->to($user->email);
                $message->subject("Hi there! $user->name", "Please Activate your account.");
            }
        );
    }
}
