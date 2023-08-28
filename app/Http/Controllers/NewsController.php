<?php

namespace App\Http\Controllers;

use App\Models\Massage;
use App\Models\News;
use Exception;
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

        return view('News.news', compact('news'));
    }

    /**
     * GET Public News
     */
    public function listPublic(){
        $news = DB::table('news')->orderByDesc('id')->paginate(10);

        $newsPanel = DB::table('news')->orderByDesc('id')->limit(4)->get();
        return view('news.news-public', compact('news', 'newsPanel'));
    }

    /**
     * GET Public Search News
     */
    public function listPublicSearch(Request $request){
        $news = DB::table('news')->where('title', 'like', '%'.$request->search.'%')
        ->orderByDesc('id')->paginate(10);

        $newsPanel = DB::table('news')->orderByDesc('id')->limit(4)->get();

        return view('news.news-public', compact('news', 'newsPanel'));
    }

    /**
     * GET Detail News
     */
    public function details(string $slug){
        $news = DB::table('news')->select('news.*', 'massages.massage_box', 'massages.status as status_massage')
        ->leftJoin('massages', 'news.id_massage','=', 'massages.id')
        ->where('news.slug', '=', $slug)->first();
        
        if($news->massage_box != null){
            $news->massage_box = unserialize($news->massage_box);
        }
        
        return view('News/public-detail', compact('news'));
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
            'img-thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:4024'],
            'details' => 'required',
            'massage' => ['required', 'in:yes,no']
        ]);

        try{
            DB::beginTransaction();
            if($request->massage == "yes"){
                $massage = Massage::create(['code' => Str::random(25), 'status' => 'aktif']);
                $massage = $massage->id;
            }else{
                $massage = null;
            }

            $type = $request->file('img-thumbnail')->getClientOriginalExtension();
            $filename = substr($request->title, 0, 10) . "_" . date('dmy') . "_" . Str::random(20) . "." . $type;
            
            News::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'desc' => 'text deskripsi berita',
                'details' => $request->details,
                'img' => $filename,
                'id_massage' => $massage,
                'created_by' => Auth::user()->email
            ]);
            $request->file('img-thumbnail')->move(public_path('image/news/thumbnail'), $filename);
            DB::commit();
            return redirect()->route('news.list')->with('success', 'News Succsess Created');
        } catch( Exception $ex){
            DB::rollBack();

            return redirect()->back()->withErrors(["News Failed Created, Try again later", $ex->getMessage()]);
        }
    }

    /**
     * GET Update News
     */
    public function update(string $slug){
        $news = DB::table('news')
        ->select("news.*", "massages.status as massage_status")
        ->leftJoin("massages", "massages.id", "=", "news.id_massage")
        ->where('news.slug', '=', $slug)->first();;

        return view('News/news-update', compact('news'));

        // return dd($news);
    }

    /**
     * POST Update News
     */
    public function postUpdate(Request $request, string $slug){
        $news = DB::table('news')->select('id')->where('slug', '=', $slug)->first();
        $news = News::findOrFail($news->id);
        $request->validate([
            'title' => ['required', 'max:100'],
            'details' => 'required',
            'img-thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4024'],
        ]);

        try{
            DB::beginTransaction();

            // update massage table
            if($news->id_massage != null && $request->massage == 'no'){
                $massage = Massage::findOrFail($news->id_massage);
                $massage->status = "nonaktif";
                $massage->save();

                $massage = $massage->id;
            }else if($news->id_massage != null && $request->massage == 'yes'){
                $massage = Massage::findOrFail($news->id_massage);
                $massage->status = "aktif";
                $massage->save();

                $massage = $massage->id;
            }

            // create massage table
            if($news->id_massage == null && $request->massage == 'no'){
                $massage = null;
            }else if($news->id_massage == null && $request->massage == 'yes'){
                $massage = Massage::create(['code' => Str::random(25), 'status' => 'aktif']);

                $massage = $massage->id;
            }


            if($request->hasFile('img-thumbnail')){
                $type = $request->file('img-thumbnail')->getClientOriginalExtension();
                $filename = substr($request->title, 0, 10) . "_" . date('dmy') . "_" . Str::random(20) . "." . $type;
                // return dd($filename);
    
                // move file
                $request->file('img-thumbnail')->move(public_path('image/news/thumbnail'), $filename);
    
                // remove old image
                $OldImgThum = $news->img;
                if(file_exists(public_path('image/news/thumbnail/') . $OldImgThum)){
                    unlink(public_path('image/news/thumbnail/') . $OldImgThum);
                }
    
                $news->title = $request->title;
                $news->details = $request->details;
                $news->img = $filename;
            } else{
                
                $news->title = $request->title;
                $news->details = $request->details;
            }
            
            $news->id_massage = $massage;
            $news->save();
            DB::commit();
            return redirect()->route('news.list')->with('success', 'News Succsess Updated');
        } catch(Exception $ex){
            DB::rollBack();

            return $ex->getMessage();
        }
    }

    /**
     * GET Delete News
     * 
     * Delete Logic
     */
    public function delete(int $id){
        $news = News::find($id);

        if(!$news){
            return redirect()->route('users.list')->with('errors', 'Failed to Delete, News Not Found');
        }

        if(file_exists(public_path('image/news/thumbnail/') . $news->img)){
            unlink(public_path('image/news/thumbnail/') . $news->img);
        }

        $news->delete();
        return redirect()->route('news.list')->with('success', 'News Succsess Deleted');

    }

    /**
     * News Search dashboard
     * 
     */
    public function searchDas(Request $request){
        $news = DB::table('news')
        ->where("title", "like", "%". $request->search ."%")
        ->orWhere("created_by", "like", "%". $request->search ."%")
        ->paginate(10);

        return view('news.news', compact('news'));
    }
}
