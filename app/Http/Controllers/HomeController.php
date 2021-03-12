<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Validator;

class HomeController extends BaseController {

    public function showLogin() {
        // show the form
        return view('home');
    }

    public function doLogin(Request $request) {
        // process the form

        //todo validation

        $creds = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if(Auth::attempt($creds)){
            return Redirect::to('/');
        }else{
            // validation not successful, send back to form
            return Redirect::to('login');
        }
    }

    public function doLogout() {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/'); // redirect the user to the login screen
    }
}
