<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Sentinel;
use Reminder;
use App\Models\User;
use Mail;
use Session;

class ForgotPasswordController extends Controller
{
    // to show forgot password view
    public function forgot_show() {
        return view ('security.show_forgot');
    }

    // to send email to user's email for changing password
    public function forgot_send_email(Request $request) {
        $user = User::whereEmail($request->email)->first();
        if($user == null){
            Session::flash('statuscode', 'error');
            return redirect()->back()->with(['status' => "Email does not exists."]);
        }
        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user) ? :Reminder::create($user);
        $this->sendEmail($user, $reminder->code);
        Session::flash('statuscode', 'success');
        return redirect()->back()->with(['status' => "Reset password code have been sent to your email."]);
    }

    // sendEmail function
    public function sendEmail($user, $code) {
        Mail::send(
            'email.forgot',
            ['user' => $user, 'code' => $code],
            function($message) use ($user) {
                $message->to($user->email);
                $message->subject("$user->name, Reset Password | LegaShop");
            }
        );
    }

    // reset password
    public function reset($email, $code) {
        $user = User::whereEmail($email)->first();
        if($user == null){
            Session::flash('statuscode', 'error');
            return redirect()->back()->with(['status' => "Email does not exists."]);
        }
        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user);
        $reminder_code = Reminder::where('user_id', '==', $user->id)
                                ->orWhere('completed', '==', 0)->first();

        if($reminder) {
            if($code == $reminder_code->code) {
                return view('security.reset_pass')->with(['user' => $user, 'code' => $code]);
            }else {
                return redirect('/');
            }
        }else {
            echo 'Session expired';
        }
    }

    public function reset_password(Request $request, $email, $code) {
        $this->validate($request, [
            'password' => 'required|min:7|max:12|confirmed',
            'password_confirmation' => 'required|min:7|max:12'
        ]);
        
        $user = User::whereEmail($email)->first();
        if($user == null){
            echo 'Email doesnt exist';
        }
        
        $user = Sentinel::findById($user->id);
        $reminder = Reminder::exists($user);
        $reminder_code = Reminder::where('user_id', '==', $user->id)
                                ->orWhere('completed', '==', 0)->first();

        if($reminder){
            if($code == $reminder_code->code){
                Reminder::complete($user, $code, $request->password);
                 Session::flash('statuscode', 'success');
                return redirect('/sentinel_login')->with(['status' => "Success! Please login with your new password."]); 
            }else{
                return redirect('/');
            }
        }else{
            echo 'Your session has expired.';
        }
    }
}


