<?php

namespace App\Service;
use Illuminate\Support\Facades\DB;
class ActivityService{

    /**
     * Data Activity This Week
     * 
     * ambil data activity hanya pada minggu tertentu unutan berdasarkan tanggal
     */
    public function activityWeek(){
        $activitys = DB::table('activities')
        ->where('tanggal', '>=', date("Y-m-d", strtotime(now())))
        ->orderBy('tanggal')
        ->get();

        $activitys->map(function($activity){
            $activity->details = unserialize($activity->details);
        });

        return $activitys;
    }
}