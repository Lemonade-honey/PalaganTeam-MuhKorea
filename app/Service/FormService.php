<?php

namespace App\Service;

use App\Models\UsersDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class FormService{
    public function accountFormJoined(): object{
        $user = UsersDetails::find(Auth::user()->id);
        if($user->form){
            $form = unserialize($user->form);
            if($form == null || !is_array($form)) return (object) null;

            foreach($form as $data){
                $forms[] = $data;
            }

            $formJoined = DB::table("forms")
            ->whereIn("slug", $forms)
            ->orderByDesc("id")
            ->get();

            return $formJoined;
        }

        return (object) null;
    }
}