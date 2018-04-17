@extends('layout.basic')

@section('title', '登录')

@section('header')
    @endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="login">
                <form action="" method="POST">
                    {{ csrf_field() }}
                    <h3 class="system">用户登录</h3>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <input class="form-control" placeholder="用户名" type="text" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                            <input class="form-control" placeholder="密码" type="password" name="password">
                        </div>
                    </div>
                    <div class="form-group volidate">
                        <div class="input-group col-xs-7 col-sm-7 col-md-7">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-check"></span>
                            </div>
                            <input class="form-control volidate-input validlogin " placeholder="请输入验证码" type="text" name="verifyCode">
                            <input type="hidden" value="" class="vericodes" name="verifyCode_confirmation">
                        </div>
                        <canvas id="canvas" class="canvas" width="140" height="50"></canvas>
                        <p class="errlogin errall"></p>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" value="1">
                            记住我
                        </label>
                        <a class="forget-pwd" href="">忘记密码?</a>
                    </div>
                    <div class="form-group">
                        <button type="button" class="form-control btn">登录</button>
                    </div>
                    <div class="form-group reg">
                        没有账号?<a href="reg" title="立即注册">立即注册</a>
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
            $('.btn').on('click',function () {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url:'login',
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
                                    window.location.href='{{ Route('home') }}';
                                },800);
                            }
                        });
                    },
                    error:function () {
//                        alert('error');
                    }
                });
            });
        });
    </script>
@endsection