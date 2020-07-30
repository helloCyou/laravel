<?php

namespace App\Http\Controllers;

use Composer\Command\ValidateCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {

        return view('login');
    }

    public function store(Request $request)
    {
        dd($request->all());die();
        $data = $this->validate($request,[
            'email'=>'email|required',
            'password'=>'required|min:5'
        ]);
        if(Auth::attempt($data))
        {
            session()->flash('success','登录成功');
            return redirect('/');
        }

        session()->flash('danger','登录失败，账号或密码不正确');
        return back();
    }
    public function logout()
    {
        \Auth::logout();
        session()->flash('success','退出成功');
        return redirect('/');
    }
}
