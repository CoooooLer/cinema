@extends('layout.basic')

@section('title','放映室')

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
                {{--@foreach($cinema['data']['cinemaDetailModel'] as $cinema2)--}}
                    {{--@foreach($cinema1['cinemaDetailModel'] as $cinema2)--}}
                        <div class="filmInfo-info" style="margin-top: -50px">
                            <h3>{{ $cinema['data']['cinemaDetailModel']['nm'] }}</h3>
                            <p>
                                {{ $cinema['data']['cinemaDetailModel']['addr'] }}
                                {{--@foreach($results['genres'] as $key=>$value)--}}
                                    {{--<span>{{ $value }}</span>--}}
                                {{--@endforeach--}}
                            </p>
                            <p>电话：{{ $cinema['data']['cinemaDetailModel']['tel'][0] }}</p>
                            <h4>影院服务————————————————————</h4>
                            {{--@foreach($cinema['data']['cinemaDetailModel']['featureTags'] as $cinema)--}}
                            {{--<p><div style="">{{ $cinema['desc'] }}</div></p>--}}
                            {{--@endforeach--}}
                            {{--<a href="" data-movieId="" class="filmInfo-ticket movieId">电影详情</a>--}}
                        </div>
                    {{--@endforeach--}}
                {{--@endforeach--}}
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 80px">
        <div class="movie-info-show">
            <div class="movie-title-show">
                <h3 class="title">title</h3>
                <span>7.6分</span>
            </div>
            <div class="more-info-show">
                <div><span class="key">时长：</span><span class="value">11111</span></div>
                <div><span class="key">类型：</span><span class="value">动作</span></div>
                <div><span class="key">主演：</span><span class="value">22222</span></div>
            </div>
        </div>
        <div class="movie-date-show">
            <span>观影时间 :</span>
            <span class="date-item add-red-color" data-index="0">今天 {{ $date }}</span>
            <span class="date-item" data-index="1">明天 {{ $date1 }}</span>
        </div>
        <div class="screen-box">
            <div class="screen-title screen-bg" style="background: #f7f7f7">
                <div>放映时间</div>
                <div>语言版本</div>
                <div>放映厅</div>
                <div>售价(元)</div>
                <div>选座购票</div>
            </div>
            @foreach($screens as $screen)
                <div class="screen-content screen-bg">
                    <div>{{ $screen->s_start }}到{{ $screen->s_end }}</div>
                    <div>国语</div>
                    <div>{{ $screen->s_name }}</div>
                    <div>{{ $screen->price }}</div>
                    <div><a href="selectSeat?sId={{ $screen->sId }}" class="ticket">立即购票</a></div>
                </div>
            @endforeach
            {{--<div class="screen-content screen-bg">--}}
                {{--<div>11</div>--}}
                {{--<div>22</div>--}}
                {{--<div>33</div>--}}
                {{--<div>44</div>--}}
                {{--<div>55</div>--}}
            {{--</div>--}}
            {{--<div class="screen-content screen-bg">--}}
                {{--<div>11</div>--}}
                {{--<div>22</div>--}}
                {{--<div>33</div>--}}
                {{--<div>44</div>--}}
                {{--<div>55</div>--}}
            {{--</div>--}}
            {{--<div class="screen-content screen-bg">--}}
                {{--<div>11</div>--}}
                {{--<div>22</div>--}}
                {{--<div>33</div>--}}
                {{--<div>44</div>--}}
                {{--<div>55</div>--}}
            {{--</div>--}}
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script>
        $(document).ready(function () {
           $('.screen-bg').map(function (i) {
               if(i%2==0)
               {
                   $(this).addClass('add-bgColor-grey');
               }
           });
        });
    </script>
@endsection
