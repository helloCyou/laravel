@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{$user->name}}</h1>
            @auth()
            <div class="text-center">
                <a href="{{route('user.follow',$user)}}" class="btn-success btn">
                    {{$name}}
                </a>
            </div>
            @endauth
        </div>
        <div class="card-body">
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

                        </td>

                        <td>
                            <form action="{{route('blog.destroy',$blog)}}" method="post">
                                @csrf  @method("DELETE")
                                <button class="btn btn-danger">删除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <div class="card-footer text-muted">
                {{$blogs->links()}}
            </div>
        </div>

    </div>
@endsection