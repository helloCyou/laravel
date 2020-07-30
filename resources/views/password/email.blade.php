@extends('layouts.default')
@section('content')
    <form action="{{route('FindPasswordSend')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                找回密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" name="email" id="" class="form-control" >
                    <small id="helpId" class="text-muted">请输入注册时的邮箱</small>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-success">确定</button>
            </div>
        </div>
    </form>
@endsection