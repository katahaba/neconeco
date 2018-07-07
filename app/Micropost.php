<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

// 多:多の表現、今回は仕様上いらない
//     public function favoriters()//ファヴォしてくれてるユーザーたちを獲得（これいるかな？）
//     {
//         return $this->belongsToMany(User::class, 'favorites','micropost_id', 'user_id' )->withTimestamps();
//     }

}
