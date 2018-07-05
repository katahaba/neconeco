<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts(){
        return $this->hasMany(Micropost::class);
    }
    

//多:多の表現
    public function followings()//フォローしている関係になるユーザーたちを獲得
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()//フォローしてくれてる関係になるユーザーたちを獲得
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    
    public function follow($userId)
    {
        // 既にフォローしているかの確認boolian
        $exist = $this->is_following($userId);
        // 自分自身ではないかの確認boolian
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // 自分をフォローしようとしているか、既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        // 既にフォローしているかの確認boolian
        $exist = $this->is_following($userId);
        // 自分自身ではないかの確認boolian
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていれば(かつ自分でなければ)フォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
//操作しようとしている対象のIDがすでにfollow_idカラムに存在しているかどうか=既followかどうかの判定関数
    public function is_following($userId) {
        return $this->followings()->where('follow_id', $userId)->exists();
    }

}
