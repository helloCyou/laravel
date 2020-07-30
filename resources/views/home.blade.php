@extends('layouts.default'){{--//选择继承哪个模板--}}
@section('content'){{--  /*填写占位的地方*/--}}
@auth()
    <form action="{{route('blog.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                添加博客
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for=""></label>
                    <textarea class="form-control" name="content">{{old('content')}}</textarea>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn-success btn">提交</button>
            </div>
        </div>
    </form>
@endauth
<div class="card mt-2">
    <div class="card-header">
        博客列表
    </div>
    <div class="card-body ">
        <table class="table">
            <thead>
            <tr>
                <th>内容</th>
                <th>作者</th>
            </tr>
            </thead>
            <tbody>
            @foreach($blogs as $blog)
                <tr>
                    <td scope="row">{{$blog['content']}}
                        @can('delete',$blog)
                            <form action="{{route('blog.destroy',$blog)}}" method="post">
                                @csrf  @method("DELETE")
                                <button class="btn btn-danger">删除</button>
                            </form>
                        @endcan
                    </td>

                    <td>{{$blog->user->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
        {{$blogs->links()}}
    </div>
</div>
@endsection