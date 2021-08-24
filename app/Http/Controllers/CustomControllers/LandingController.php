<?php

namespace App\Http\Controllers\CustomControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{
     // function to view Landing
     public function redirectToLanding(Request $request) {
        return view('landing.landing');
    }

    // function to show login page in custom
    public function show_login() {
        return view('custom_auth.login');
    }

    
}
