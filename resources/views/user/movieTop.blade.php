@extends('layout.basic')

@section('title','影片排行榜')

@section('header')
    @parent
@endsection

@section('content')
    <div class="container" style="margin-top: 81px">
        <h1>电影排行榜</h1>
        <div class="movie-top-content">
            <div class="movie-top-left">
                @foreach($movies['subjects'] as $movie)
                    <div class="movie-top-unit">
                        <div class="img">
                            <img src="{{ $movie['images']['small'] }}" alt="">
                        </div>
                        <div class="movie-info-box">
                            <div class="movie-top-title">
                                <a><p>{{ $movie['title'] }}/{{ $movie['original_title'] }}</p></a>
                            </div>
                            <div class="movie-top-type">
                                @foreach($movie['genres'] as $key=>$value)
                                    <span>{{ $value }}</span>
                                @endforeach
                            </div>
                            <div class="movie-top-info">
                                {{ $movie['year'] }}/
                                {{ $movie['directors'][0]['name'] }}
                                @foreach($movie['casts'] as $role)
                                    <span>{{ $role['name'] }}</span>/
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endforeach
                {{--<div class="movie-top-unit">--}}
                    {{--<div class="img">--}}
                        {{--<img src="https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2505914883.webp" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="movie-info-box">--}}
                        {{--<div class="movie-top-title">--}}
                            {{--<a><p>血观音</p></a>--}}
                        {{--</div>--}}
                        {{--<div class="movie-top-type">--}}
                            {{--血腥--}}
                        {{--</div>--}}
                        {{--<div class="movie-top-info">--}}
                            {{--2017--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="movie-top-right">
                <div class="hot-title">今日票房</div>
                <div class="today-list">
                    @foreach($usa['subjects'] as $data)
                        <div class="today-unit">
                            <a href="" class="today-unit-a">
                                <div class="today-unit-left">
                                    <span class="addColor-today">{{ $data['rank']}}</span>
                                    <span>{{ $data['subject']['title'] }}</span>
                                </div>
                                <span class="addColor-today">{{ $data['box']/10000 }}万$</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection