<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Massage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function create(){
        return view('Form/form-create');
    }

    public function postCreate(Request $request){
        $request->validate([
            'title' => ['required', 'max:200', 'unique:forms'],
            'desc' => ['required', 'max:100'],
            'status_form' => ['required', 'in:public,private'],
            'password' => 'required',
            'details' => 'required'
        ]);

        try{
            DB::beginTransaction();
            if($request->has('form-massage')){
                $massage = Massage::create(['code' => Str::random(25)]);
                $massage = $massage->id;
            }else{
                $massage = null;
            }

            $form = Form::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'desc' => $request->desc,
                'details' => $request->details,
                'status' => $request->status_form,
                'password' => $request->password,
                'id_massage' => $massage,
            ]);
            DB::commit();
            return dd($form);
        }catch(Exception $ex){
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * GET Public List Form
     */
    public function index(){

    }

    /**
     * GET Public Form Details
     */
    public function details(string $slug){
        if(!DB::table('forms')->where('slug', '=', $slug)->exists()){
            return abort(404);
        }
        $form = DB::table('forms')->select('forms.*', 'massages.massage_box', 'massages.massage_history')
        ->leftJoin('massages', 'forms.id_massage','=', 'massages.id')
        ->where('forms.slug', '=', $slug)->first();
        
        if($form->massage_box != null){
            $form->massage_box = unserialize($form->massage_box);
        }

        // validasi
        if($form->status == 'private'){
            if($form->register != null){
                $form->register = unserialize($form->register);
                if(in_array(auth()->user()->email, $form->register)){
                    return view('Form/public-form-detail', compact('form'));
                }else{
                    return view('Form/form-password', ['slug' => $slug]);
                }
            }
            return view('Form/form-password', ['slug' => $slug]);
        }else{
            return view('Form/public-form-detail', compact('form'));
        }
    }

    /**
     * POST Password Form
     */
    public function formPassword(Request $request, string $slug){
        $request->validate([
            'password' => 'required'
        ]);

        $form = DB::table('forms')->where('slug', '=', $slug)->first();
        if($form->password == $request->password){
            if($form->register != null){
                $array = unserialize($form->register);
                array_push($array, auth()->user()->email);
                $register = serialize($array);
            }else{
                $register = serialize([auth()->user()->email]);
            }

            $form = DB::table('forms')->where('slug', '=', $slug)->update(['register' => $register]);
            return redirect()->route('public.form.details', ['slug' => $slug]);
        }else{
            return back()->withErrors('password is wrong');
        }
    }
}
