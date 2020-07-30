@extends('layouts.default')
@section('content')
    <form action="{{route('FindPasswordUpdate')}}" method="post">
        <input type="hidden" value="{{$user['email_token']}}" name="token">
        @csrf
        <div class="card">
            <div class="card-header">
                重置密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" name="email" id="" class="form-control" value="{{$user['email']}}" disabled >
                </div>
                <div class="form-group">
                    <label for="">密码</label>
                    <input type="password" name="password" id="" class="form-control" >
                    <small id="helpId" class="text-muted">请输入新的密码</small>
                </div>
                <div class="form-group">
                    <label for="">确认密码</label>
                    <input type="password" name="password_confirmation" id="" class="form-control" >
                    <small id="helpId" class="text-muted">请重新输入密码</small>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-success">确定</button>
            </div>
        </div>
    </form>
@endsection