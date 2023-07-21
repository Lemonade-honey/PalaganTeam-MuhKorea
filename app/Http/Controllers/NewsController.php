<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * GET List as DESC
     */
    public function list(){
        $news = DB::table('news')->orderByDesc('id')->paginate(10);

        // $news->map( function($news){
        //     $news->details = unserialize($news->details);
        // });

        // dd($news);
        return view('News/news-list', compact('news'));
    }

    /**
     * GET Detail News
     */
    public function details(string $slug){
        $news = DB::table('news')->where('slug', '=', $slug)->first();
        dd($news);
    }

    /**
     * GET Craete News
     */
    public function create(){
        return view('News/news-create');
    }

    /**
     * POST Create News
     */
    public function postCreate(Request $request){
        $request->validate([
            'title' => ['required', 'max:100', 'unique:news'],
            'details' => 'required',
            // 'img-thumbnail' => ['required', 'image', 'max:1024'],
        ]);

        // image logic
        $imgUse = explode(",", $request->temp);
        foreach($imgUse as $img){
            $data = explode("/image/temp/", $img);
            $path = "/image/temp/" . $data[1];
            $target = "/image/news/" . $data[1];
            if(file_exists(public_path(). $path)){
                rename(public_path() . $path, public_path() . $target);
            }
        }

        News::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'details' => $request->details,
            'img' => 'null image',
            'created_by' => Auth::user()->name
        ]);
        return redirect()->route('news.list')->with('succsess', 'News Succsess Created');
    }

    /**
     * GET Update News
     */
    public function update(string $slug){
        return $slug;
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
