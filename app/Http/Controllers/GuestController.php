<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User; 

class GuestController extends Controller
{
    public function welcome(){

        return view('welcome');
    }

    public function verify($token){

        $user = User::where('activation_token', $token)->first();

        if(!$user){
            abort(400, 'Not allowed');
        }
        //if the user exists:
        $user->activation_token = null;
        $user->is_active = 1;
        $user->save();
        Auth::login($user);
        return redirect()->route('home');
    }
}
