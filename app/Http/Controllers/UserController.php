<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * GET List User Account
     */
    public function list(){
        $users = DB::table('users')->orderByDesc('id')->paginate(10);

        return view('User/user-list', compact('users'));
    }
}
