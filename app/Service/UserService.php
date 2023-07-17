<?php

namespace App\Service;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
class UserService{
    /**
     * Login Service
     */
    public function loginService($request){
        $inputfield = $request->only('email', 'password');
        $remember = $request->has('remember');
        if(Auth::attempt($inputfield, $remember)){
            if($remember){
                $user = Auth::user();
                $user->setRememberToken(md5(time() . $user->email));
                $user->save();
            }

            return true;
        }else{
            return false;
        }
    }

    /**
     * Register Service
     */
    public function registerService($request){
        $user = User::create($request->except('_token'));

        event(new Registered($user));
    }
}