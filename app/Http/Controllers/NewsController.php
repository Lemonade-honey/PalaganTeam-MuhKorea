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
            'img-thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2024'],
        ]);

        $type = $request->file('img-thumbnail')->getClientOriginalExtension();
        $filename = substr($request->title, 0, 10) . "_" . date('dmy') . "_" . Str::random(20) . "." . $type;
        
        News::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'details' => $request->details,
            'img' => $filename,
            'created_by' => Auth::user()->name
        ]);
        $request->file('img-thumbnail')->move(public_path('image/news/thumbnail'), $filename);
        return redirect()->route('news.list')->with('success', 'News Succsess Created');
    }

    /**
     * GET Update News
     */
    public function update(string $slug){
        $news = DB::table('news')->where('slug', "=", $slug)->first();

        return view('News/news-update', compact('news'));

        // return dd($news);
    }

    /**
     * POST Update News
     */
    public function postUpdate(Request $request, string $slug){
        $request->validate([
            'title' => ['required', 'max:100'],
            'details' => 'required',
            'img-thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2024'],
        ]);

        if($request->hasFile('img-thumbnail')){
            $type = $request->file('img-thumbnail')->getClientOriginalExtension();
            $filename = substr($request->title, 0, 10) . "_" . date('dmy') . "_" . Str::random(20) . "." . $type;

            // move file
            $request->file('img-thumbnail')->move(public_path('image/news/thumbnail'), $filename);

            // remove old image
            $OldImgThum = DB::table('news')->select('img')->where('slug', '=', $slug)->first();
            if(file_exists(public_path('image/news/thumbnail/') . $OldImgThum->img)){
                unlink(public_path('image/news/thumbnail/') . $OldImgThum->img);
            }

            $news = DB::table('news')->where('slug', '=', $slug)->update(
                [
                    'title' => $request->title,
                    'details' => $request->details,
                    'img' => $filename,
                    'updated_at' => date('Y-m-d H:i:s', strtotime(now()))
                ]
            );

        } else{
            $news = DB::table('news')->where('slug', '=', $slug)->update(
                [
                    'title' => $request->title,
                    'details' => $request->details,
                    'updated_at' => date('Y-m-d H:i:s', strtotime(now()))
                ]
            );
        }

        return redirect()->route('news.list')->with('success', 'News Succsess Updated');
    }

    /**
     * GET Delete News
     * 
     * Delete Logic
     */
    public function delete(string $slug){
        if(DB::table('news')->where('slug', '=', $slug)->exists()){
            $img = DB::table('news')->select('img')->where('slug', '=', $slug)->first();
            if(file_exists(public_path('image/news/thumbnail/') . $img->img)){
                unlink(public_path('image/news/thumbnail/') . $img->img);
            }
            DB::table('news')->where('slug', '=', $slug)->delete();
            return redirect()->route('news.list')->with('success', 'News Succsess Deleted');
        }else{
            return redirect()->route('news.list')->withErrors('Failer Delete, News not found');
        }

    }
}
