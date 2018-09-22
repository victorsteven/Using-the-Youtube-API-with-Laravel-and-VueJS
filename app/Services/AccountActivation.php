<?php

namespace App\Services;
use App\User;
// use Illuminate\Support\Facades\Mail;
use App\Mail\ActivateUserAccount;

class AccountActivation {

    private function generateToken(){

        return mt_rand() . time();
    }

    //lets listen for the Registered event when it is fired

    public function handle($registeredUser){
        //the "user" is passed in the Registered Event, so we are calling it here
        // logger($registeredUser->user);

        $user = User::find($registeredUser->user->id);
        $user->activation_token = $this->generateToken();

        $user->save();

        \Mail::to($user)->queue(new ActivateUserAccount($user));
    }
}