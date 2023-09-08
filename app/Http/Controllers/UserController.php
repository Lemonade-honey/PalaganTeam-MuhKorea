<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * GET List User Account
     */
    public function list(){
        $users = DB::table('users')->orderByDesc('id')->paginate(10);

        return view('User/user', compact('users'));
    }

    /**
     * GET Details User
     */
    public function details(int $id){
        $user = DB::table('users')
        ->select('users.*', 'users_details.*')
        ->leftJoin('users_details', 'users.email', '=', 'users_details.email')
        ->where('users.id', '=', $id)
        ->first();
        if(!$user){
            return redirect()->route('users.list')->with('errors', 'User Not Found');
        }

        $data = unserialize($user->data);
        if(!$data){
            $data = [
                'skill' => [],
                'hobby' => []
            ];
        }

        return view('User/user-detail', compact('user', 'data'));
    }

    /**
     * GET Update User
     */
    public function update(int $id){
        $user = User::find($id);
        if(!$user){
            return redirect()->route('users.list')->with('errors', 'User Not Found');
        }

        return view('User/user-update', compact('user'));
    }

    /**
     * POST Update User
     */
    public function postUpdate( Request $request, int $id){
        $request->validate([
            'name' => ['required', 'max:150'],
            'role' =>['required', 'in:user,staf,admin']
        ]);

        $user = User::find($id);
        if(!$user){
            return redirect()->route('users.list')->with('errors', 'Failed Update, User Not Found');
        }

        $user->name = $request->name;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.list')->with('success', 'User Success Update');
    }

    /**
     * Search User
     */
    public function search(Request $request){
        $users = DB::table('users')
        ->where("name", "like", "%". $request->search . "%")
        ->orWhere("email", "like", "%". $request->search ."%")
        ->paginate(10);

        return view('User/user', compact('users'));
    }


    /**
     * GET Delete User
     */
    public function delete(int $id){
        $user = User::find($id);
        $userDetail = UsersDetails::find($id);

        if(!$user){
            return redirect()->route('users.list')->with('errors', 'Failed to Delete, User Not Found');
        }

        $user->delete();
        $userDetail->delete();
        return redirect()->route('users.list')->with('success', 'User Success Delete');
    }
}
