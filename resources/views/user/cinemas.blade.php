@extends('layout.basic')

@section('title','电影院')

@section('header')
    @parent
@endsection

@section('content')
    @parent
    <div class="container" style="margin-top: 80px">
        <div class="cinema-title">
            <div class="cinema-line">|</div>
            <h3>影院列表</h3>
        </div>
        <div class="cinema-list">
            @foreach( array_values($cinemas['data'])[9] as $cinema1)
                {{--@foreach($cinema1 as $cinema2)--}}
                    <div class="cinema-unit">
                        <div class="cinema-info">
                            {{--{{ $key }}--}}
                            <a href="">{{ $cinema1['nm'] }}</a>
                            <span>地址：{{ $cinema1['addr'] }}</span>
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
@endsection
