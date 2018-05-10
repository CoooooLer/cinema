@extends('layout.basic')

@section('title','影片信息')

@section('header')
    @parent
@endsection

@section('content')
    <div class="filmInfo-banner">
        <div class="wrapper">
            <div class="filmInfo-box">
                <div class="filmInfo-img">
                    <img src="https://images.weserv.nl/?url={{ substr($results['images']['small'],7) }} " alt="">
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
                    <a href="cinema?id={{ $results['id'] }}" class="filmInfo-ticket">立即购票</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="filmInfo-content-box">
            <div class="filmInfo-content-introduce">
                <span>剧情简介</span>
            </div>
            <div class="filmInfo-content">
                <span>{{ $results['summary'] }}</span>
            </div>
            <div class="filmInfo-role-title">
                <span>演职人员</span>
            </div>
            <div class="filmInfo-role-box">
                <div class="director-box">
                    <div class="role-title">导演</div>
                    <div class="role-img"><img src="https://images.weserv.nl/?url={{ substr( $results['directors'][0]['avatars']['small'] ,7) }}" alt=""></div>
                    <div class="role-name">{{ $results['directors'][0]['name'] }}</div>
                </div>
                @foreach($results['casts'] as $role)
                    <div class="role-box">
                        <div class="role-title">演员</div>
                        <div class="role-img"><img src="https://images.weserv.nl/?url={{ substr($role['avatars']['small'],7) }}" alt=""></div>
                        <div class="role-name">{{ $role['name'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('footer')
    @parent
@endsection