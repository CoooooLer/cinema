@extends('layout.basic')

@section('title','电影')

@section('header')
    @parent
    @endsection

@section('content')
    @parent
    <div class="film-nav">
        <div class="film-nav-list">
            {{--<a class="film-nav-unit film-nav-list-addColor" href="">正在热映</a>--}}
            <a class="film-nav-unit" href="">即将上映</a>
            {{--<a class="film-nav-unit" href="">经典影片</a>--}}
        </div>
    </div>
    <div class="container">
        {{--<div class="tags">--}}
            {{--<div class="type tag-box">--}}
                {{--<div class="tag-title">类型：</div>--}}
                {{--<div class="tag-content">--}}
                    {{--<a data-type="">爱情</a>--}}
                    {{--<a>喜剧</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="area tag-box">--}}
                {{--<div class="tag-title">区域：</div>--}}
                {{--<div class="tag-content">--}}
                    {{--<a>爱情</a>--}}
                    {{--<a>喜剧</a>--}}
                    {{--<a>爱情</a>--}}
                    {{--<a>喜剧</a>--}}
                    {{--<a>爱情</a>--}}
                    {{--<a>喜剧</a>--}}
                    {{--<a>爱情</a>--}}
                    {{--<a>喜剧</a>--}}
                    {{--<a>爱情</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="year tag-box">--}}
                {{--<div class="tag-title">类型：</div>--}}
                {{--<div class="tag-content">--}}
                    {{--<a>爱情</a>--}}
                    {{--<a>喜剧</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="sorts">
            {{--<input type="radio" name="sort" value="按热门排序">按热门排序--}}
            {{--<input type="radio" name="sort" value="按热门排序">按时间排序--}}
            {{--<input type="radio" name="sort" value="按热门排序">按热门排序--}}
        </div>
        <div class="content-home-hot-box">
            <div class="content-home" style="width: 1200px;">
                <div class="hot-content">
                    <div class="hot-movie-list">
                        @foreach($movies['subjects'] as $movie1)
                            {{--@foreach($movie1 as $movie2)--}}
                            <div class="hot-movie-unit">
                                <div class="hot-img-box">
                                    <a href=" movieInfo?id={{ $movie1['id'] }} " target="_blank"><img src="https://images.weserv.nl/?url={{ substr($movie1['images']['large'],7) }}"></a>
                                    {{--<div class="hot-movie-title">--}}
                                    {{--{{ $movie1['title'] }}--}}
                                    {{--</div>--}}
                                </div>
                                <div class="movie-info-box">
                                    <a href="movieInfo?id={{ $movie1['id'] }}" class="movie-info" target="_blank" title="{{ $movie1['title'] }}" data-psource="title">
                                        {{ $movie1['title'] }}
                                    </a>
                                </div>
                                <a href="movieInfo?id={{ $movie1['id'] }}" class="hot-ticket">选座购票</a>
                            </div>
                            {{--@endforeach--}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


@endsection

@section('footer')
    @parent
    <script>
        $.each($('.film-nav-unit'),function (k,v) {
            $(v).on('click',function () {
                console.log(v);
               $(this).addClass('.film-nav-list-addColor').siblings().removeClass('.film-nav-list-addColor') ;
            });
        })
    </script>
@endsection