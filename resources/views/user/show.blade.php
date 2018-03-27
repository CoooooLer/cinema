@extends('layout.basic')

@section('title','电影院')

@section('header')
    @parent
@endsection

@section('content')
    @parent
    <div class="filmInfo-banner">
        <div class="wrapper">
            <div class="filmInfo-box">
                <div class="filmInfo-img">
                    {{--<img src=" {{ $results['images']['small'] }} " alt="">--}}
                </div>
                <div class="filmInfo-info">
                    {{ $price }}
                    {{--<h3>{{ $results['title'] }}</h3>--}}
                    {{--<p>--}}
                        {{--@foreach($results['genres'] as $key=>$value)--}}
                            {{--<span>{{ $value }}</span>--}}
                        {{--@endforeach--}}
                    {{--</p>--}}
                    {{--<p>{{ $results['countries'][0] }}</p>--}}
                    {{--<p>{{ $results['year'] }}大陆上映</p>--}}
                    {{--<a href="movieInfo?id={{ $results['id'] }}" data-movieId="{{ $results['id'] }}"--}}
                       {{--class="filmInfo-ticket movieId">电影详情</a>--}}
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 80px">

        {{--<div class="tags">--}}
        {{--<div class="type tag-box">--}}
        {{--<div class="tag-title">品牌：</div>--}}
        {{--<div class="tag-content">--}}
        {{--<a data-type="">爱情</a>--}}
        {{--<a>喜剧</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="type tag-box">--}}
        {{--<div class="tag-title">地区：</div>--}}
        {{--<div class="tag-content">--}}
        {{--<a data-type="">爱情</a>--}}
        {{--<a>喜剧</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="area tag-box">--}}
        {{--<div class="tag-title">影厅：</div>--}}
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
        {{--<a>喜剧</a>--}}
        {{--<a>爱情</a>--}}
        {{--<a>喜剧</a>--}}
        {{--<a>爱情</a>--}}
        {{--<a>喜剧</a>--}}
        {{--<a>爱情</a>--}}
        {{--<a>喜剧</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="cinema-title">
            <div class="cinema-line">|</div>
            <h3>影院列表</h3>
        </div>
        <div class="cinema-list">
            @foreach( array_values($cinemas['data'])[0] as $cinema1)
                {{--@foreach($cinema1 as $cinema2)--}}
                <div class="cinema-unit">
                    <div class="cinema-info">
                        {{--{{ $key }}--}}
                        <a href="">{{ $cinema1['nm'] }}</a>
                        <span>地址：{{ $cinema1['addr'] }}</span>
                    </div>
                    <div class="cinema-ticket">
                        <div class="price" data-price="{{ $cinema1['sellPrice'] }}">￥{{ $cinema1['sellPrice'] }}起</div>
                        <a href="javascript:void(0)" data-cinemaId="{{ $cinema1['id'] }}" class="seat">选座购票</a>
                    </div>
                </div>
                {{--@endforeach--}}
            @endforeach
            {{--<div class="cinema-unit">--}}
            {{--<div class="cinema-info">--}}
            {{--<a href="">橙天影城(遵义店)</a>--}}
            {{--<span>地址：红花岗区中山路好百领商场二楼</span>--}}
            {{--</div>--}}
            {{--<div class="cinema-ticket">--}}
            {{--<div class="price">￥23起</div>--}}
            {{--<a href="" class="">选座购票</a>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script>

    </script>
@endsection
