<?php

namespace App\Http\Controllers;

use App\Models\Massage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MassageController extends Controller
{

    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }

    public function store( Request $request, int $id, string $slug){
        $massage = Massage::find($id);
        if(!$massage){
            return redirect(url()->previous())->with('errors', 'Failed To Post Massage. Code 001');
        }

        // logic
        if($massage->massage_box != null){
            $data = unserialize($massage->massage_box);
            $data[] =[
                'code' => Str::random(5),
                'by' => Auth::user()->name,
                'email' => Auth::user()->email,
                'time' => date('H:i:s, d F Y', strtotime(now())),
                'massage' => $request->massage,
                'reply' => []
            ];
            $data = serialize($data);

            $history = unserialize($massage->massage_history);
            $massage_history = [
                "action" => 'POST',
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "time" => date('H:i:s, d F Y', strtotime(now()))
            ];
            array_push($history, $massage_history);
            $history = serialize($history);
        }else{
            $data = serialize([
                [
                    'code' => Str::random(5),
                    'by' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'time' => date('H:i:s, d F Y', strtotime(now())),
                    'massage' => $request->massage,
                    'reply' => []
                ]
            ]);

            $massage_history = [
                "action" => 'POST',
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "time" => date('H:i:s, d F Y', strtotime(now()))
            ];
            $history = serialize($massage_history);
        }
        $massage->massage_box = $data;
        $massage->massage_history = $history;

        $massage->save();

        // redirect back with massage
        return redirect(url()->previous())->with('success', 'Sucses');
    }

    /**
     * POST Delete Massage
     */
    public function delete(int $id, string $slug, string $kode){
        $massage = Massage::find($id);
        if(!$massage){
            return redirect(url()->previous())->with('errors', 'Failed To Delete Massage. Code 001');
        }

        if($massage->massage_box != null){
            $array = unserialize($massage->massage_box);
            foreach($array as $key => $value){
                if($value['code'] == $kode){
                    unset($array[$key]);
                    break;
                }
            }
            $massage->massage_box = serialize($array);
            
            $history = unserialize($massage->massage_history);
            $massage_history = [
                "action" => 'Delete',
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "time" => date('H:i:s, d F Y', strtotime(now()))
            ];
            array_push($history, $massage_history);
            $massage->massage_history = serialize($history);

            // save
            $massage->save();
        }

        // redirect back
        return redirect(url()->previous())->with('success', 'Sucses');
    }

    /**
     * POST Reply Massage
     */
    public function storeReply(Request $request, int $id, string $slug, string $kode){
        $massage = Massage::find($id);
        if(!$massage){
            return redirect(url()->previous())->with('errors', 'Failed To Delete Massage. Code 001');
        }

        if($massage->massage_box != null){
            $array = unserialize($massage->massage_box);
            foreach($array as $key => $value){
                if($value['code'] == $kode){
                    $data = [
                        'code' => Str::random(5),
                        'by' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'time' => date('H:i:s, d F Y', strtotime(now())),
                        'massage' => $request->reply
                    ];
                    array_push($array[$key]['reply'], $data);
                    break;
                }
            }

            $massage->massage_box = serialize($array);
            
            $history = unserialize($massage->massage_history);
            $massage_history = [
                "action" => 'POST',
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "time" => date('H:i:s, d F Y', strtotime(now()))
            ];
            array_push($history, $massage_history);
            $massage->massage_history = serialize($history);

            // save
            $massage->save();
        }

        return redirect(url()->previous())->with('success', 'Sucses');
    }

    /**
     * GET Delete Replay Massage
     */
    public function deleteReply(int $id, string $slug, string $kode, string $replyKode){
        $massage = Massage::find($id);
        if(!$massage){
            return redirect(url()->previous())->with('errors', 'Failed To Delete Massage. Code 001');
        }

        if($massage->massage_box != null){
            $array = unserialize($massage->massage_box);
            // return dd($array);
            foreach($array as $key => $value){
                if($value['code'] == $kode){
                    foreach($value['reply'] as $item => $reply){
                        if($reply['code'] == $replyKode){
                            unset($array[$key]['reply'][$item]);
                            break;
                        }
                    }
                    break;
                }
            }

            $massage->massage_box = serialize($array);
            
            $history = unserialize($massage->massage_history);
            $massage_history = [
                "action" => 'Delete',
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "time" => date('H:i:s, d F Y', strtotime(now()))
            ];
            array_push($history, $massage_history);

            $massage->massage_history = serialize($history);

            $massage->save();
        }
        return redirect(url()->previous())->with('success', 'Sucses');
    }

    /**
     * GET TEST Massage 
     */
    public function test(int $id, string $slug, string $kode){
        $massage = Massage::find($id);

        $massage->massage_box = unserialize($massage->massage_box);
        return dd($massage);
    }
}
