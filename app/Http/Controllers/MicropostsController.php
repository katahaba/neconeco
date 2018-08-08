<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Storage;
use Validator;
use Image;
use App\Micropost;
use App\User;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $microposts = DB::table('microposts')->orderBy('created_at', 'desc')->paginate(10);
        
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
            $data += $this->counts($user);
            return view('microposts.index', $data);
        }else {
            return view('welcome');
        }
    }
   

    public function show($id)
    {
        $micropost = Micropost::find($id);
        return view('microposts.show', ['micropost' => $micropost]);
    }
    
    public function create()
    {
        $data = [];
        $user = \Auth::user();
        $microposts =$user->microposts();
        $data = ['user' => $user, 'microposts' => $microposts];
        $data += $this->counts($user);
        
        return view('microposts.create',$data);
    }
    
    
    
    public function store(Request $request)
    {
        $micropost = $request->user()->microposts()->create([
            'image_path' => $request->file('photo'),
            'search_tag' => $request->search_tag,
            'map_lat' => $request->lat,
            'map_long' => $request->long,
        ]);
        
         $validator = Validator::make($request->all(),[
        'photo' => 'required|image|max:100000',
        'search_tag' => 'nullable',
        'map_lat' => 'nullable',
        'map_long' => 'nullable',
        ]);
        
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        
        $fileName = $request->photo->getClientOriginalName();
        $fileName = time()."@".$fileName;
        
        //写真用外部ライブラリ、Intervention Imageを使用
        $image = Image::make($request->file('photo')->getRealPath());
        //画像リサイズ
        $image->resize(null, 300, function ($constraint) {
        $constraint->aspectRatio();
        });
        //アップロード先とhttpリクエスト参照先とDB保存
        $image->save(storage_path() . '/app/public/images/' .  $fileName);
        $micropost->image_path = 'storage/images/'. $fileName;
        $micropost->save();
        return redirect()->route('microposts.show', ['id' => \Auth::id(), 'micropost' =>$micropost ])->with('success','ファイルはアップロードされました。');
    }
    

    public function destroy($id)
    { 
        $micropost = Micropost::find($id);

        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }
        return redirect('/');
    }  
}
