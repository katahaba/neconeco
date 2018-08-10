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
        
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        
        // getClientOriginalName()：ファイルのオリジナル名からサムネ用の一意の名前を生成
        $fileName = $validator['photo']->getClientOriginalName();
        $fileName = time()."@".$fileName;
        
        // getRealPath()：webサーバーに一時的にアップロードしたファイルのパスを取得します。
        //写真用外部ライブラリ、Intervention Imageを使用、サムネ用に新たなファイルを作る
        // $image = Image::make($request->file('photo')->getRealPath());
        // //画像リサイズ
        // $image->resize(null, 300, function ($constraint) {
        // $constraint->aspectRatio();
        // });
        // $image->save(storage_path() . '/app/public/images/' .  $fileName);
        
        $path = $request->file('photo')->storeAs('images',$fileName,'s3');
        
        $micropost->image_path = $path;
        $micropost->save();
        return redirect()->route('microposts.show', ['id' => \Auth::id(), 'micropost' =>$micropost ])->with('success','ファイルはアップロードされました。');

        
        
        
        /* ファイルパスから参照するURLを生成する */
        // $url = Storage::disk('s3')->url($path);
        // $micropost->image_path = $url;
        
        
        // アップロード先
        // $image->save(storage_path() . '/app/public/images/' .  $fileName);
        // 画像をサーバーに保存する
        // $micropost->image_path = 'storage/images/'. $fileName;
        // 
        // return redirect()->route('microposts.show', ['id' => \Auth::id(), 'micropost' =>$micropost ])->with('success','ファイルはアップロードされました。');
    }
    

    public function destroy($id)
    { 
        $micropost = Micropost::find($id);

        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }
        return redirect('/');
    }  
    
    
    public function search(Request $request)
    { 
        //dd($request);
        $keywords = [];
        $keywords = explode(",", $request->search_words);
        // キーワードの数だけループして、LIKE句の配列を作る
        $keywordCondition = [];
        foreach ($keywords as $keyword) {
            $keywordCondition[] = 'search_tag LIKE "%' . $keyword . '%"';
        }
        
        // ここで、 
        // [ 'search_tag LIKE "%hoge%"', 
        //   'search_tag LIKE "%piyo%"' ]
        // という配列ができあがっている。
        
        // これをANDでつなげて、文字列にする
        $keywordCondition = implode(' AND ', $keywordCondition);
    
        // あとはSELECT文にくっつける
        //dd('SELECT * FROM microposts WHERE ' . $keywordCondition);
        //$sql = DB::select('SELECT * FROM microposts WHERE ' . $keywordCondition . ' ORDER BY created_at DESC');
        
        $sql = DB::table('microposts')->whereRaw($keywordCondition)->orderBy('created_at', 'desc')->paginate(10);
       
        return view('microposts.search', ['sql' => $sql]);
    }
}