@extends('layout.basic')

@section('title','购票管理')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container-fluid" style="padding: 0 40px 0 40px;height: 80vh;">
        <div class="row">
            <div class="page-right">
                <div class="box-body manager">
                    <div id="userList" class="users-list">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户</th>
                                <th>电影院</th>
                                <th>影厅</th>
                                <th>电影</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>座位</th>
                                <th>时间</th>
                                <th>票价</th>
                                <th>电话</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <form action="" method="" class="ticket">
                                    {{ csrf_field() }}
                                    <tr>
                                        <input type="hidden"  class="ticketId" value="{{ $ticket->id }}" />
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->username }}</td>
                                        <td>{{ $ticket->cinema_name }}</td>
                                        <td>{{ $ticket->s_name }}</td>
                                        <td>{{ $ticket->movie_name }}</td>
                                        <td>{{ $ticket->s_start }}</td>
                                        <td>{{ $ticket->s_end }}</td>
                                        <td>{{ $ticket->row }}排{{ $ticket->column }}座</td>
                                        <td>{{ $ticket->date }}</td>
                                        <td>{{ $ticket->price }}</td>
                                        <td>{{ $ticket->phone }}</td>
                                        <td>
                                            <input type="button"class="btn btn-danger btn-sm drop" data-ticketId={{ $ticket->id }} value="退票" />
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--退票确认模态框 .drop start--}}
    <div class="modal fade dropTicket" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="color: #d9534f;">退票对话框</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: center">退票成功后，所付费用将在两小时之内退回到账户</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-danger btn-confirm" data-dismiss="modal">确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{--退票确认模态框 .drop end--}}

@endsection

@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            $('.drop').map(function (i) {
                $(this).on('click',function () {
                    $_this = $(this);
                    $ticketId = $(this).attr('data-ticketId');
//                    console.log($ticketId);
                    $('.dropTicket').modal('show');
                    $('.btn-confirm').on('click',function () {
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                        $.ajax({
                            url:'adminDropTicket',
                            type:'post',
                            data:{'ticketId':$ticketId},
                            success:function (data) {
//                                console.log(data);
                                if(data === 'success')
                                {
//                                    console.log($_this.parents());
                                    $_this.parents('tr').remove();
                                    alert('退票成功');
                                }
                            },

                        });

                    });
                });
            });
        });
    </script>
@endsection