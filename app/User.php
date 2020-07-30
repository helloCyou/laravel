<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function blogs(){
        return $this->hasMany(Blog::class,'user_id');//不写默认为 字段为 关联模型名_id
    }

    /**
     * 根据user_id  去follows  表中查找 有多少粉丝
     * user_id  为主
     * follower 为粉丝
     */
    public function follower(){
        return $this->belongsToMany(User::class,'follows','user_id','follower');
    }


    /**
     * 根据 follower 去follows  表中查找 关注了 多少
     * user_id  为主
     * follower 为粉丝
     */
    public function following(){
        return $this->belongsToMany(User::class,'follows','follower','user_id');
    }


    /**
     * @param $uid
     * @return mixed
     * 查看用户是不是自己的粉丝
     */
    public function isFollow($uid){
        return $this->follower()->wherePivot('follower',$uid)->first();
    }

    /**
     * @param $ids
     * @return array
     *关注或者 取关
     */
    public function followToggle($ids){
        $ids = is_array($ids)?:[$ids];
        return $this->follower()->withTimestamps()->toggle($ids);
    }
}
