<style>
    .content{
        height: 100%;
    }

</style>

@extends('layout.basic')

@section('title','修改个人资料')

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
                            <strong class="box-title">编辑用户</strong>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-left">
                            <form id="userForm">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $user->uid }}"  name="id">
                                <div class="form-group">
                                    <label>用户名</label>
                                    <input type="text" class="form-control disabled" value="{{ $user->username }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="password">新密码</label>
                                    <input type="password" class="form-control" id="password" name="password" max="100" placeholder="新密码,不改密码请为空">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">确认密码</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" maxlength="20" placeholder="确认密码">
                                </div>
                                <div class="form-group">
                                    <label>手机号</label>
                                    <input type="text" class="form-control" id="userPhone" name="phone" size="11" title="手机号码" placeholder="手机号码" value="{{ $user->phone }}" >
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-success saveUserInfo" value="保存修改" />
                                    <span id="form-error-message" class="error-message"></span>
                                </div>
                            </form>
                            {{--提示框--}}
                            <div class="msg-box"></div>
                            <div class="null" style="height: 50px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            $('.saveUserInfo').on('click',function() {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'editPersonInfo',
                    type:'post',
                    data:$('#userForm').serialize(),
                    success:function (data) {
                        $.each(data,function (k,v) {
                            $html =  `
                                <div class="flash-message">
                                    <p class="alert alert-${k}" style="text-align: center">
                                        ${v}
                                     </p>
                                </div>
                            `
                            $('.msg-box').html($html);
                            {{--if(k == 'success')--}}
                            {{--{--}}
                                {{--setTimeout(function () {--}}
                                    {{--window.location.href='{{ Route('editPerson') }}';--}}
                                {{--},2000);--}}
                            {{--}--}}
                        });
                    }
                });
            });
        });
    </script>
@endsection
