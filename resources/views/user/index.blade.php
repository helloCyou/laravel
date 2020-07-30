@extends('layouts.default')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>email</th>
            <th width="250px">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td scope="row">{{$user['id']}}</td>
                <td>{{$user['email']}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @can('delete',$user)
                            <form action="{{route('user.destroy',$user)}}" method="post">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger">删除</button>
                            </form>
                        @endcan
                        @can('update',$user)
                            <a href="{{route('user.edit',$user)}}" type="submit" class="btn btn-info">修改</a>
                        @endcan
                        <a href="{{route('user.show',$user)}}" type="button" class="btn btn-secondary">查看</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <div class="card-footer text-muted">
        {{$users->links()}}
    </div>
@endsection