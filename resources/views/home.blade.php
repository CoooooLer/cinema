@extends('layout.basic')

@section('title','主页')

@section('header')
    @parent
@endsection

@section('content')
    <div class="banner">
        <div class="banner-background"></div>
        <div class="yesbanner">
            <div class="yesbanner-right">
                <div class="yesbanner-right-top">
                    <div class="banner-imgdiv">
                        <a href="" class="right-banner"
                             data-image="img/banner1.jpg">
                            <img src="img/banner1.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                           data-image="img/banner2.jpg">
                            <img src="img/banner2.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="img/banner3.jpg">
                            <img src="img/banner3.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="img/banner4.jpg">
                            <img src="img/banner4.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="img/banner5.jpg">
                            <img src="img/banner5.jpg"
                                 alt="">
                        </a>
                        <a href="" class="right-banner"
                             data-image="img/banner6.jpg">
                            <img src="img/banner6.jpg"
                                 alt="">
                        </a>
                    </div>
                    <div class="dian">
                        <div class="dian-o" data-index="0"></div>
                        <div class="dian-o" data-index="1"></div>
                        <div class="dian-o" data-index="2"></div>
                        <div class="dian-o" data-index="3"></div>
                        <div class="dian-o" data-index="4"></div>
                        <div class="dian-o" data-index="5"></div>
                    </div>
                    <div class="leftt">
                        <div class="leftt-l"><</div>
                    </div>
                    <div class="rightt">
                        <div class="rightt-r">></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content-home-hot-box">
            <div class="content-home-hot">
                <div class="hot-title-box">
                    <span class="hot-title">正在上映（20部）</span>
                    <a class="hot-all" href="">全部></a>
                </div>
                <div class="hot-content">
                    <div class="hot-movie-list">
                        @foreach($movies['subjects'] as $movie1)
                            {{--@foreach($movie1 as $movie2)--}}
                                <div class="hot-movie-unit">
                                    <div class="hot-img-box">
                                        <a href=" movieInfo?id={{ $movie1['id'] }} " target="_blank"><img src="https://images.weserv.nl/?url={{ substr($movie1['images']['large'] ,7) }}"></a>
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
            <div class="content-home-today">
                <div class="hot-title">今日票房</div>
                <div class="today-list">
                    @foreach($usa['subjects'] as $data)
                        <div class="today-unit">
                            <a href="" class="today-unit-a">
                                <div class="today-unit-left">
                                    <span class="addColor-today">{{ $data['rank']}}</span>
                                    <span>{{ $data['subject']['title'] }}</span>
                                </div>
                                <span class="addColor-today">{{ $data['box']/10000 }}万￥</span>
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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/banner.js"></script>
    <script>

//        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
//        $.ajax({
//           url:'https://movie.douban.com/j/search_subjects?type=tv&tag=%E7%83%AD%E9%97%A8&page_limit=50&page_start=0',
//           type:'get',
//           dataType:'jsonp',
//            jsonp:'callback',
//           success:function(data) {
//               console.log(data);
//           },
//           error:function () {
//               alert(0);
//           },
//        });
//        axios.get('https://movie.douban.com/j/search_subjects?type=tv&tag=%E7%83%AD%E9%97%A8&page_limit=50&page_start=0')
//            .then(function (response) {
//                console.log(response);
//            })
//            .catch(function (error) {
//                console.log(error);
//            });
    </script>

@endsection