<?php

namespace App\Http\Controllers;

use App\Models\UsersDetails;
use App\Service\ActivityService;
use App\Service\FormService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private ActivityService $activity;
    private FormService $forms;

    public function __construct(){
        $this->middleware(['auth', 'verified']);
        $this->activity = new ActivityService;
        $this->forms = new FormService;
    }
    public function index(){
        $forms = $this->forms->accountFormJoined();
        $activitys = $this->activity->activityWeek();

        // admin only
        $totalForm = DB::table('forms')->count();
        $totalUser = DB::table('users')->count();
        
        return view('Dashboard/dashboard', compact('activitys', 'forms', 'totalForm', 'totalUser'));
    }

    public function profile(){
        $user = DB::table('users')
        ->select('users.*', 'users_details.*')
        ->leftJoin('users_details', 'users.email', '=', 'users_details.email')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = unserialize($user->data);
        if(!$data){
            $data = [
                'skill' => [],
                'hobby' => []
            ];
        }
        return view('Dashboard/user-public', compact('user', 'data'));
    }

    public function edit(){
        $user = DB::table('users')
        ->select('users.*', 'users_details.*')
        ->leftJoin('users_details', 'users.email', '=', 'users_details.email')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = unserialize($user->data);
        if(!$data){
            $data = [
                'skill' => [],
                'hobby' => []
            ];
        }

        return view('Dashboard/user-public-edit', compact('user', 'data'));
    }


    public function postEdit(Request $request){

        $user = UsersDetails::findOrFail(Auth::user()->id);

        $request->validate([
            'handphone' => ['nullable', 'numeric'],
            'address' => ['nullable', 'max:1000']
        ]);

        $skill = $hobby = array();

        if($request->skill != null){
            foreach($request->skill as $skills){
                if($skills != null || $skills != ''){
                    $skill[] = $skills;
                }
            }
        }

        if($request->hobbys != null){
            foreach($request->hobbys as $hobbys){
                if($hobbys != null || $hobbys != ''){
                    $hobby[] = $hobbys;
                }
            }
        }

        $data = [
            'skill' => $skill,
            'hobby' => $hobby
        ];

        $user->handphone = $request->handphone;
        $user->address = $request->address;
        $user->data = serialize($data);
        $user->save();

        return redirect()->route('profile')->with('success', 'success update profile');
    }
}
