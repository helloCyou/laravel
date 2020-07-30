<?php

namespace App\Http\Controllers;

use App\Notifications\PasswordNotify;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //找回密码界面
    public function email(){

        return view('password.email');
    }
    //发送邮件页面
    public function send(Request $request){
//        dd($request->toArray());
        $user = User::where('email',$request->email)->first();
        \Notification::send($user,new PasswordNotify($user->email_token));
        return view('password.send');
    }
    //重置密码界面
    public function edit($token){
//        $user = User::where('email_token',$token)->first();
        $user = $this->getUserToken($token);
        return view('password.edit',compact('user'));
    }
    //重置密码提交方法
    public function update(Request $request){

        $this->validate($request,[
            'password'=>'min:|required|confirmed'
        ]);
        $user = $this->getUserToken($request->token);
        $user->password = bcrypt($request->password);
        $user->save();

        session()->flash('success','密码修改成功');
        return redirect()->route('login');
    }

    protected function getUserToken($token){
        return User::where('email_token',$token)->first();;
    }
}
