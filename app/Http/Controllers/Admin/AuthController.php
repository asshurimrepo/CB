<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function page(){
    	return view('admin');
    }

    public function verify(Request $request){

    	$email = $request->input('email');
    	$password = $request->input('password');

    	if (Auth::attempt(['email' => $email, 'password' => $password, 'user_role' => 'admin'])) {
            // Authentication passed...
            return redirect()->intended('admin');
        }

        return redirect()->back()->withInput($request->all());

    }
}
