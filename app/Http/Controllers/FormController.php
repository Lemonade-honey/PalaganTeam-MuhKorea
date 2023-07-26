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
                $massage = Massage::create(['code' => Str::random(25), 'status' => 'aktif']);
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
     * GET List Form
     */
    public function list(){
        $form = DB::table('forms')->orderByDesc('id')->paginate(10);

        return view('Form/form-list', compact('form'));
    }

    /**
     * GET Update Form
     */
    public function update(string $slug){
        $form = DB::table('forms')->where('slug', '=', $slug)->first();
        if(!$form){
            return redirect()->route('form.list')->with('errors', 'Form Not Found');
        }
        
        $form->register = unserialize($form->register);
        return view('Form/form-update', compact('form'));
    }

    /**
     * POST Update Form
     */
    public function postUpdate(Request $request, string $slug){
        $request->validate([
            'title' => ['required', 'max:200', 'unique:forms'],
            'desc' => ['required', 'max:100'],
            'status_form' => ['required', 'in:public,private'],
            'password' => 'required',
            'details' => 'required'
        ]);
    }

    /**
     * GET List Member Registerd
     */
    public function memberRegister(string $slug){
        $form = DB::table('forms')->where('slug', '=', $slug)->where('register', '!=', null)->first();
        if(!$form){
            return redirect()->route('form.list')->with('errors', 'Form Not Found');
        }

        $member = unserialize($form->register);
        $slug = $form->slug;
        return view('Form/form-list-member', compact('member', 'slug'));
    }

    public function memberDelete(string $slug, string $email){
        $form = DB::table('forms')->where('slug', '=', $slug)->where('register', '!=', null)->first();
        if(!$form){
            return redirect()->route('form.list')->with('errors', 'Form Not Found');
        }
        try {
            $member = unserialize($form->register);
            foreach($member as $key => $userEmail){
                if($userEmail == $email){
                    unset($member[$key]);
                    break;
                }
            }

            DB::table('forms')->where('slug', '=', $slug)->where('register', '!=', null)->update(['register' => serialize($member)]);
            return redirect()->back()->with('success', "Success Delete Member");
        } catch (Exception $ex) {
            return redirect()->back()->with('errors', "Failed Delete Member. " . $ex->getMessage());
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
        $form = DB::table('forms')->select('forms.*', 'massages.massage_box', 'massages.status as status_massage')
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
