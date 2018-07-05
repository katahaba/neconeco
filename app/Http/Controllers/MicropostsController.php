<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();//'\'はIlluminate\Support\Facades\Auth;を意味しておりグローバル名前空間というらしい
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = ['user' => $user,
            'microposts' => $microposts,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else{
            return view('welcome');
        }
    }
    
    public function store(Request $request)
    {
        $this->validate($request, ['content'=> 'required|max:191',]);
        
        $request->user()->microposts()->create(['content' => $request->content,]);
        
        return redirect()->back();
    }

     public function destroy($id)
     {  
        $micropost = \App\Micropost::find($id);

        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }

        return redirect()->back();
     }  
}
