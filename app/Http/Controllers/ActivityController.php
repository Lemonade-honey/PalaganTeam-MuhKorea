<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function list(){
        $activitys = DB::table('activities')->where('tanggal', '>=', '2023/07/09')
        ->orderBy('tanggal')
        ->get();

        $activitys->map(function ($activitys){
            $activitys->details = unserialize($activitys->details);
        });

        dd($activitys);
    }

    /**
     * GET Create Activity Page
     */
    public function craete(){

    }

    /**
     * POST Create Activity Page
     */
    public function postCreate(Request $request){

    }

    /**
     * GET Update Activity Page
     */
    public function update(){

    }

    /**
     * POST Update Activity Page
     */
    public function postUpdate(Request $request){

    }

    /**
     * GET Delete Activity (Only Staff)
     * 
     * Hapus langsung
     */
    public function delete($id){

    }
}
