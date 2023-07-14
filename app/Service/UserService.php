<?php

namespace App\Service;
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
}