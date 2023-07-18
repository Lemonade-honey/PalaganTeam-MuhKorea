<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * GET List as DESC
     */
    public function list(){
        $news = DB::table('news')->orderByDesc('id')->get();

        $news->map( function($news){
            $news->details = unserialize($news->details);
        });
        dd($news);
    }

    /**
     * GET Detail News
     */
    public function details(string $slug){
        $news = DB::table('news')->where('slug', '=', $slug)->first();
        $news->details = unserialize($news->details);
        dd($news);
    }

    /**
     * GET Craete News
     */
    public function create(){

    }

    /**
     * POST Create News
     */
    public function postCreate(Request $request){
        
    }

    /**
     * GET Update News
     */
    public function update(string $slug){

    }

    /**
     * POST Update News
     */
    public function postUpdate(Request $request, string $slug){

    }

    /**
     * GET Delete News
     */
    public function delete(string $slug){

    }
}
