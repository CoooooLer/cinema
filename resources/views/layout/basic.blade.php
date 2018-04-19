<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>@yield('title')</title>
</head>
<body>
    @section('header')
        <div class="header">
            <div class="header-content">
                <div class="logo"><img src="img/logo.png"></div>
                <div class="header-nav">
                    <a href="{{ Route('home') }}" class="nav-unit header-nav-active primary">首页</a>
                    <a href="{{ Route('movie') }}" class="nav-unit">电影</a>
                    <a href="{{ Route('cinemas') }}" class="nav-unit">影院</a>
                    <a href="{{ Route('movieTop') }}" class="nav-unit">榜单</a>
                    <a class="nav-unit">热点</a>
                    <div class="nav-slider"></div>
                </div>
                <div class="search has-error">
                    <input class="form-control keyword" id="sea-keyword" placeholder="找电影...按Enter搜索" style="height: 40px">
                </div>
                <div class="nav-login" role="navigation">

                    @if(Cookie::has('username'))

                        <ul class="nav-login-lo">
                            <li class="dropdown ">
                                <a href="#" class="" data-toggle="dropdown" role="button"  aria-expanded="true">&nbsp;&nbsp;{{ Cookie::get('username') }}&nbsp;&nbsp;<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="personal"><span class="glyphicon glyphicon-user"></span>个人中心</a></li>
                                    <li><a href="editPerson?username={{ Cookie::get('username') }}"><span class="glyphicon glyphicon-user"></span>修改资料</a></li>

                                    @if(  Cookie::get('username') === 'admin'  )
                                        <li><a href="userList"><span class="glyphicon glyphicon-user"></span>用户管理</a></li>
                                        <li><a href="ticketList"><span class="glyphicon glyphicon-user"></span>购票管理</a></li>
                                    @endif
                                    <li><a href=" {{ Route('logOut') }} "><span class="glyphicon glyphicon-user"></span>退出登录</a></li>
                                    {{--<li><a href="{{ Route('user.show') }}"><span class="glyphicon glyphicon-user"></span>个人中心</a></li>--}}
                                    {{--<li><a href="{{ Route('user.project') }}"><span class="glyphicon glyphicon-list"></span>我的项目</a></li>--}}
                                    {{--<li><a href="{{ Route('dashboard') }}"><span class="glyphicon glyphicon-home"></span>后台管理</a></li>--}}
                                    {{--<li><a href="{{ Route('user.logOut') }}"><span class="glyphicon glyphicon-log-out"></span>退出登录</a></li>--}}
                                </ul>
                            </li>
                        </ul>
                    @else
                        <ul class="nav-login-lo">
                            <li><a href="{{route('log')}}">登录</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    @show
<div class="content" style="overflow: hidden">
    @section('content')
        @show
</div>
    @section('footer')

        <div class="footer">
            <p>友情链接：<a href="javascript:void(0)">猫眼电影</a>|<a href="">百度糯米</a></p>
            <p>@2018 时光电影 </p>
        </div>
        <script src="js/jquery.min.js"></script>
        {{--<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>--}}
        <script src="js/bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                //顶部导航栏的切换
                $.each($('.nav-unit') , function (k,v) {
                    $(v).on('mouseover',function () {
                        $('.nav-slider').css({'transition':'all ease 0.5s','left':v.offsetLeft + 'px'});
                    });
                    $(v).on('mouseleave',function () {
                        $('.nav-slider').css({'transition':'all ease 0.5s','left': 0 + 'px'});
                    });
//                    $(v).on('click',function () {
//                        $(this).css({'color':'red'}).siblings().css({'color':'#000'});
//                    })
                });
                $('.header-nav a').on('click',function () {
                    $(this).css({'color':'orange'}).siblings().css({'color':'#000'});
                });
                switch(window.location.href)
                {
                    case $('.header-nav a').eq(1).attr('href'):
                        $('.header-nav a').eq(1).css({'color':'orange'});
                        console.log(window.location.href);
                        break;
                    case $('.header-nav a').eq(2).attr('href'):
                        $('.header-nav a').eq(2).css({'color':'orange'});
                        console.log(window.location.href);
                        break;
                    case $('.header-nav a').eq(3).attr('href'):
                        $('.header-nav a').eq(3).css({'color':'orange'});
                        console.log(window.location.href);
                        break;
                    case $('.header-nav a').eq(4).attr('href'):
                        $('.header-nav a').eq(4).css({'color':'orange'});
                        console.log(window.location.href);
                        break;
                }

                //搜索
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $('.keyword').on('keypress',function (e) {
                   if(e.keyCode == 13)
                   {
                        $keyword = $('.keyword').val();
                        $.ajax({
                            url:'search',
                            type:'get',
                            data:{'keyword': $keyword},
                            success:function (data) {
                                console.log(data['subjects']);
                                $movies = data;
                                $html = '';
                                $.each(data['subjects'],function (i,val) {
                                    $html += `

                                        <div class="hot-movie-unit">
                                            <div class="hot-img-box">
                                                <a href=" movieInfo?id=${val['id']} " target="_blank"><img src="${val['images']['large']}"></a>

                                                </div>
                                                <div class="movie-info-box">
                                                    <a href="movieInfo?id=${val['id']}" class="movie-info" target="_blank" title="${val['title']}" data-psource="title">
                                                    ${val['title']}
                                                </a>
                                            </div>
                                        </div>
                                    `
                                });
                                    $('.hot-movie-list').html($html);
                                },
                        });
                   }
                });
            })

        </script>
        @show
</body>
</html>
