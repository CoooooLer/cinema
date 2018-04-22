@extends('layout.basic')

@section('title','注册')

@section('header')
    @parent
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="login">
                <form action="register" method="POST">
                    {{ csrf_field() }}
                    <h3 class="system">用户注册</h3>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>&nbsp;
                            </div>
                            <input class="form-control username all" placeholder="用户名 只能用英文字和汉字" type="text" name="username">
                        </div>
                        <p class="errusername errall"></p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                            <input class="form-control password all" placeholder="密码" type="password" name="password">
                        </div>
                        <p class="errpassword errall"></p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                            <input class="form-control pwds all" placeholder="确认密码" type="password" name="password_confirmation">
                        </div>
                        <p class="errpwds errall"></p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </div>
                            <input class="form-control userePhone all" placeholder="用户电话" type="text" name="phone">
                        </div>
                        <p class="erruseremail errall"></p>
                    </div>
                    <div class="form-group volidate">
                        <div class="input-group col-xs-7 col-sm-7 col-md-7">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-check"></span>
                            </div>
                            <input class="form-control volidate-input validate all" placeholder="请输入验证码" type="text" name="verifyCode">
                            <input type="hidden" value="" class="vericodes" name="verifyCode_confirmation">

                        </div>
                        <canvas id="canvas-r" class="canvas" width="140" height="50"></canvas>
                        <p class="errvalidate errall"></p>
                    </div>
                    <div class="form-group">
                        <button type="button" class="form-control btn btn-r">注册</button>
                    </div>
                        <div class="form-group reg">
                            已有账号?<a href="log" title="立即注册">立即登录</a>
                        </div>
                    <div class="msg-box">

                    </div>
                    {{--提示框--}}
                    {{--@include('layout.message')--}}

                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="js/jquery.min.js"></script>
    <script src="js/canvas.js"></script>
    <script>
        $(document).ready(function () {
            $('.btn-r').on('click',function () {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'register',
                    type:'post',
                    data:$('form').serialize(),
                    success:function (data) {
//                        console.log(data);
                        $.each(data,function (k,v) {
                            $html =  `
                                <div class="flash-message">
                                    <p class="alert alert-${k}" style="text-align: center">
                                        ${v}
                                     </p>
                                </div>
                            `
                            $('.msg-box').html($html);
                            if(k == 'success')
                            {
                                setTimeout(function () {
                                    window.location.href="{{ url('log') }}";
                                },800);
                            }
                        });
                    },
                    error:function () {
                        alert('error');
                    }
                });
            });
        });
    </script>
@endsection