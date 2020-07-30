<?php

namespace App\Http\Controllers;

use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function __construct()
    {
        //使用中间件   不需要登录 也可以访问的方法
        $this->middleware('auth',[
            'except'=>['index','show','create','store','confirmEmail_token']
        ]);
        //使用中间件  只有游客 才能访问的方法
        $this->middleware('guest',[
            'only'=>['create','store']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(10);


        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * 是否关注
     */
    public function follow(User $user){
        $user->followToggle(\Auth::user()->id);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $this->validate($request,[
            'name'=>'required|min:3',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:5|confirmed'
        ]);
        $data['password'] = bcrypt($data['password']);
        //添加用户
        $user = User::create($data);
//        //自动登录
//        \Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]);
        //注册成功 为邮箱发送验证
        \Mail::to($user)->send(new RegMail($user));
        session()->flash('success','邮件发送成功 请前往邮箱邮箱中验证');
        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $blogs = $user->blogs()->paginate('10');
        if(\Auth::check())
            $name = $user->isFollow(\Auth::user()->id)?'取消关注':'关注';

        return view('user.show',compact('user',"blogs",'name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //使用模型策略 验证当前修改信息是不是  修改的的本人的信息
        $this->authorize('update',$user);
        return view('user.edit',compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
//        dd($request->all());
        $this->validate($request,[
            'name'=>'required|min:3',
            'password'=>'nullable|min:3|confirmed'
        ]);
        $user->name = $request->name;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        session()->flash('success','修改成功');
        return redirect()->route('user.show',$user);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $this->authorize('delete',$user);
        $user->delete();
        session()->flash('success','删除成功');
        return redirect()->route('user.index');
    }


    public function confirmEmail_token($token){
        $user = User::where('email_token',$token)->first();
        if($user){
            //完成邮箱验证
            $user->email_active = true;
            $user->save();
            session()->flash('success','邮箱验证成功');
            \Auth::login($user);
            return redirect('/');
        }
        session()->flash('danger','邮箱验证失败');
        return redirect('/');
    }

}
