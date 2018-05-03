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
                        <img src=" {{ $results['images']['small'] }} " alt="">
                    </div>
                    <div class="filmInfo-info">
                        <h3>{{ $results['title'] }}</h3>
                        <p>
                            @foreach($results['genres'] as $key=>$value)
                                <span>{{ $value }}</span>
                            @endforeach
                        </p>
                        <p>{{ $results['countries'][0] }}</p>
                        <p>{{ $results['year'] }}大陆上映</p>
                        <a href="movieInfo?id={{ $results['id'] }}" data-movieId="{{ $results['id'] }}"
                           class="filmInfo-ticket movieId">电影详情</a>
                        <input type="hidden" value="{{ $results['id'] }}" name="movieId" >
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 80px">
            <div class="cinema-title">
                <div class="cinema-line">|</div>
                <h3>影院列表</h3>
            </div>
            <div class="cinema-list">
                @foreach( array_values($cinemas['data'])[0] as $cinema1)
                    {{--@foreach($cinema1 as $cinema2)--}}
                    <form action="showScreen" method="get">
                        {{ csrf_field() }}
                        <div class="cinema-unit">
                            <div class="cinema-info">
                                <a href="">{{ $cinema1['nm'] }}</a>
                                <span>地址：{{ $cinema1['addr'] }}</span>
                            </div>
                            <div class="cinema-ticket">
                                <div class="price" data-price="{{ $cinema1['sellPrice'] }}">￥{{ $cinema1['sellPrice'] }}起</div>
                                <input type="hidden" value="{{ $cinema1['id'] }}" name="cinemaId">
                                <input type="hidden" value="{{ $cinema1['sellPrice'] }}" name="price">
                                {{--<a href="showScreen?movieId=$results['id']&cinemaId=$cinema1['id']&price=$cinema1['sellPrice]" data-cinemaId="{{ $cinema1['id'] }}" class="seat">选座购票</a>--}}
                                <input type="submit" class="seat btn btn-danger" value="选座购票" style="border-radius: 100px">
                            </div>
                        </div>
                    </form>
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
    <script type="text/javascript" >
        $(document).ready(function () {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            //传递影片ID和影院ID获取详细购票信息
//            $('.seat').map(function (i) {
//                $(this).on('click', function () {
//                    $movieId = $('.movieId').attr('data-movieId');
//                    $cinemaId = $('.seat').attr('data-cinemaId');
//                    $price = $('.price').eq(i).attr('data-price');
////                    console.log(movieId,cinemaId,price);
//                    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
//                    $.ajax({
//                        url: 'showScreen',
//                        type: 'get',
//                        data: {
//                            'movieId': $movieId,
//                            'cinemaId': $cinemaId,
//                            'price': $price,
//                        },
//                        success:function (data) {
//                            console.log(data);
//                        },
//                        error:function () {
//                            console.log('fail');
//                        }
//                    });
//                });
//            });

        });
    </script>
@endsection
