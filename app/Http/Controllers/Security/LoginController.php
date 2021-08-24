<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Sentinel;
use Validator;
use App\Models\Roles\RoleModel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Session;

class LoginController extends Controller
{
    // to show sentinel login - admin
    public function admin_log() {
        if(Sentinel::check()){
            if(Sentinel::getUser()->roles->first()->name == 'SuperAdmin'){
                return redirect('show_dashboard_main');
            }else{
                return redirect('/');
            }
        }
        return view('security.admin_reglog');
    }

    // Login Action
    public function admin_login(Request $request) {
        // Sentinel::disableCheckpoints();
        $errorMsgs = [
            'email.required' => 'Email is Required',
            'email.email' =>  'Your Email must be valid',
            'password.required' => 'Password is Required'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], $errorMsgs);

        if ($validator->fails()) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Please check your fields',
                'errors' => $validator->errors()->all()
            );
            Session::flash('statuscode', 'error');
            return redirect()->back()->with(['status' => "Please check your fields"]);
        }

        if($request->remember == 'on') {
            try {
                $user = Sentinel::authenticateAndRemember($request->all());
            }catch (ThrottlingException $e) {
                $delay = $e->getDelay();
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Session Expired',
                    'errors' => ["You can login again at $delay seconds."]
                );
                Session::flash('statuscode', 'error');
                return redirect()->back()->with(['status' => "You can login again in $delay seconds."]);
            }catch (NotActivatedException $e) {
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Account not Verified',
                    'errors' => ["Please Verify your account first to login."]
                );
                Session::flash('statuscode', 'error');
                return redirect()->back()->with(['status' => "Please activate your account first"]);
            }
        }else {
            try {
                $user = Sentinel::authenticate($request->all());
            }catch (ThrottlingException $e) {
                $delay = $e->getDelay();
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Session Expired',
                    'errors' => ["You can login again at $delay seconds."]
                );
                Session::flash('statuscode', 'error');
                return redirect()->back()->with(['status' => "You can login again in $delay seconds."]);
            }catch (NotActivatedException $e) {
                $returnData = array(
                    'status' => 'error',
                    'message' => 'Account not Verified',
                    'errors' => ["Please Verify your account first to login."]
                );
                Session::flash('statuscode', 'error');
                return redirect()->back()->with(['status' => "Please activate your account first"]);
            }
        }

        // login success
        if(Sentinel::check()) {
            Session::flash('statuscode', 'success');
            return redirect('show_dashboard_main')->with(['status' => "Login Success"]);
        }else {
            $returnData = array(
                'status' => 'error',
                'message' => 'Login Error',
                'errors' => ["Email & Password mismatched"]
            );
            Session::flash('statuscode', 'error');
            return redirect()->back()->with(['status' => "Email or Password mismatched."]);
        }
    } 

    // Admin logout
    public function admin_logout() {
        Sentinel::logout();
        Session::flash('statuscode', 'success');
        return redirect('sentinel_login')->with(['status' => "Logged out, See you!"]);
    }
}
