<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Micropost;
use App\Comment;

class CommentsController extends Controller
{
    
   
    public function store(Request $request, $micropost_id)
    {
        $micropost = Micropost::find($micropost_id);
        $this->validate($request, ['comment' => 'required|max:191', ]);
        $micropost->comments()->create([
            'user_id' => \Auth::User()->id,
            'micropost_id' => $micropost_id,
            'comment' => $request->comment,
        ]);
        
        return redirect()->back();
    }
}
