<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; 

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
   
    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(5);
        $data = ['user' => $user,'microposts' => $microposts];
        $data += $this->counts($user);

        return view('users.show', $data);
    }
   
    //ユーザー情報　編集    
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }
    
    public function update(Request $request)
    {   
        $user = \Auth::User();
        $user->name = $request->name;
        // $user->email= $request->email;
        $user->save();
        return view('users.edit', [
            'user' => $user
        ]);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/');
    }


    
// followings,followersアクション  
    
// 'user' => $user(操作者), 'users' => $followings(フォローしてる人たち)とその数のデータ変数を作ってviewに渡している  
//followingsとfollowersをまとめてusers.users.blade.phpで表示しているためusersという名前で渡して、$usersでviewで受け取っている。

    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(5);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }
    
    //'user' => $user(操作者), 'users' => $followers(フォロワーさんたち)とその数のデータ変数を作ってviewに渡している  

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(5);
        
        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
    
    
    public function favoritings($id)
    {
        $user = User::find($id);
        $favoritings = $user->favoritings()->paginate(5);
        
        $data = [
            'user' => $user,
            'favoritings' => $favoritings,
            //view:users.favoritingsで$favoritingsと呼び出すことで、ユーザーAのファヴォしたmicroposの一覧が表示される
        ];
        
        $data += $this->counts($user);
        
        return view('users.favoritings', $data);
    }
}