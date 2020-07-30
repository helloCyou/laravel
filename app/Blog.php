<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //这个字段可以允许我们 批量填充
    protected $fillable = ['content'];


    public function User(){
        //用来链表
        return $this->belongsTo(User::class);
    }
}
