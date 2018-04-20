<style>
    .content{
        height: 100%;
    }
    .active{
        background: #dddddd;
    }
</style>

@extends('layout.basic')

@section('title','用户管理')

@section('header')
    @parent
@endsection

@section('content')

    <div class="content">
        <div class="container manual-body">
            <div class="row">
                <div class="page-right">
                    <div class="m-box">
                        <div class="box-head">
                            <strong class="box-title">用户管理</strong>
                            <a href="create" type="button" class="btn btn-success btn-sm pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                添加用户
                            </a>
                        </div>
                    </div>
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
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <form action="deleteUser={{ $user->uId }}" method="post">
                                        {{ csrf_field() }}
                                        <tr>
                                            <td>{{ $user->uId }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td> {{ $user->created_at }} </td>
                                            <td> {{ $user->updated_at }} </td>
                                            {{--<td><span class="label label-danger">禁用</span></td>--}}
                                            <td>
                                                <a href="userEdit?uId={{ $user->uId }}" class="btn btn-sm btn-default">编辑</a>
                                                @if( $user->username != 'admin' )
                                                    @if( $user->username != Cookie::get('username'))
                                                        <input type="button" id="{{ $user->uid }}" name="{{ $user->uid }}" class="btn btn-danger btn-sm drop" value="删除" />
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </form>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--删除的模态框  start--}}
    <div class="modal fade" id="drop" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">删除用户（慎重）</h4>
                </div>
                <div class="modal-body">
                    <p>此操作会删除用户的相关信息</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger " id="btn-drop-confirm" data-dismiss="modal">确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{--删除的模态框  end--}}
@endsection


@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            //搜索的内容
            $('.keyword').on('keypress', function (e) {
                if (e.keyCode == 13) {
                    $keyword = $('.keyword').val();
                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                    $.ajax({
                        url: 'userSearch',
                        type: 'post',
                        data: {'keyword': $keyword},
                        success: function (data) {
                            $html = '';
                            $('tbody').html($html);
                            $.each(data, function (k, v) {
                                console.log(v.uid);
                                if(v.username !=  'admin')
                                {
                                        $html += `
                                 <tr>
                                    <td>${v.uid}</td>
                                    <td>${v.username}</td>
                                    <td>${v.phone}</td>
                                    <td>${v.created_at} </td>
                                    <td> ${v.updated_at} </td>
                                            <td>
                                                <a href="userId=${v.uid}" class="btn btn-sm btn-default">编辑</a>
                                            <input type="button" id="${v.uid}" name="${v.uid}" class="btn btn-danger btn-sm drop" value="删除" />

                                    </td>
                                </tr>
                                `
                                }
                                else
                                {
                                    $html += `
                                 <tr>
                                    <td>${v.uid}</td>
                                    <td>${v.username}</td>
                                    <td>${v.phone}</td>
                                    <td>${v.created_at} </td>
                                    <td> ${v.updated_at} </td>
                                        <td>
                                            <a href="userId=${v.pid}" class="btn btn-sm btn-default">编辑</a>
                                    </td>
                                </tr>
                                `
                                }

                                });
                            if($html != '')
                            {
                                $('tbody').html($html);
                            }
                            else
                            {
                                $('tbody').html("<h1 style='color: #000000;margin: 0 auto;'>无相关用户,请重新输入。。。</h1>");
                            }
                            drop();
                        }

                    });
                }
            });
        });

        //调用模态框
        function drop() {
            $('.drop').on('click',function () {
                $('#drop').modal('show');//调用模态框
                var $_this = $(this);
                var $uId = ($('.drop').attr('id'));
//                console.log($id);
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $('#btn-drop-confirm').on('click',function () {
                    $.ajax({
                        url:'deleteUser',
                        data:{'uId':$uId},
                        type:'post',
                        success:function (data) {
                            $_this.parents('tr').remove();
                        }
                    });
                });
            });
        }

        drop();


                // $('ul li').on('click',function () {
                //     $(this).addClass('active').siblings().removeClass('active');
                // });


    </script>
@endsection