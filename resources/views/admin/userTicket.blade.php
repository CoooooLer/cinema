@extends('layout.basic')

@section('title','个人中心')

@section('header')

@endsection

@section('content')
    <div class="container-fluid" style="padding: 100px 40px 0 40px;height: 80vh;">
        <div class="row">
            <div class="page-right">
                <div class="box-body manager">
                    <div id="userList" class="users-list">
                        <table class="table">
                            <thead>
                            <tr>
                                <th width="80">ID</th>
                                <th width="80">用户名</th>
                                <th>电话</th>
                                <th>创建时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                                <th>电话</th>
                                <th>创建时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--@forelse($users as $user)--}}
                            {{--<form action="deleteUser={{ $user->uid }}" method="post">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<tr>--}}
                            {{--<td>{{ $user->uid }}</td>--}}
                            {{--<td>{{ $user->username }}</td>--}}
                            {{--<td>{{ $user->phone }}</td>--}}
                            {{--<td> {{ $user->created_at }} </td>--}}
                            {{--<td> {{ $user->updated_at }} </td>--}}
                            {{--<td><span class="label label-danger">禁用</span></td>--}}
                            {{--<td>--}}
                            {{--<a href="userEdit?uId={{ $user->uid }}" class="btn btn-sm btn-default">编辑</a>--}}
                            {{--@if( $user->username != 'admin' )--}}
                            {{--@if( $user->username != Cookie::get('username'))--}}
                            {{--<input type="button" id="{{ $user->uid }}" name="{{ $user->uid }}" class="btn btn-danger btn-sm drop" value="删除" />--}}
                            {{--@endif--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--</tr>--}}
                            {{--</form>--}}
                            {{--@empty--}}
                            {{--@endforelse--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('footer')
    @parent
@endsection