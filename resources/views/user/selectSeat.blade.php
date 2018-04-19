@extends('layout.basic')

@section('title','选座')

@section('header')
    @parent
@endsection

@section('content')

    <div class="container" style="margin-top: 100px">
        <div class="line-box-seat">
            <div class="movie-line-box">
                <div class="number">1</div>
                <div class="title">选择场次</div>
                <div class="movie-line"></div>
            </div>
            <div class="seat-line-box">
                <div class="number">2</div>
                <div class="title">选择座位</div>
                <div class="movie-line"></div>
            </div>
            <div class="seat-line-box">
                <div class="number">3</div>
                <div class="title">付款</div>
                <div class="movie-line"></div>
            </div>
            <div class="ticket-line-box">
                <div class="number">4</div>
                <div class="title">取票观影</div>
                <div class="movie-line"></div>
            </div>
        </div>
        <div class="content-selectSeat">
            <div class="hall">
                <div class="seat-example">
                    <div class="white seat">
                        <span>可选座位</span>
                    </div>
                    <div class="red seat">已售座位</div>
                    <div class="green seat">已选座位</div>
                    {{--<div class="double seat" style="padding-left: 77px;">情侣座位</div>--}}
                </div>
                <div class="seat-block">
                    <div class="row-id-container">
                        @for($i=1;$i<=$row;$i++)
                            <span class="row-id">{{ $i }}</span>
                        @endfor
                    </div>
                    <div class="seat-container">
                        <div class="screen">银幕中央</div>
                        <div class="seats-wrapper">
                            <div class="row">
                                @foreach($seats as $seat)
                                    @if($seat->status === 0)
                                        <span class="seat white selectable" data-row-id="{{ $seat->row }}" data-column-id="{{ $seat->column }}"  data-no="03010101" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>
                                    @elseif($seat->status === 1)
                                        <span class="seat green selectabled" data-row-id="{{ $seat->row }}" data-column-id="{{ $seat->column }}"></span>
                                    @elseif($seat->status === -1)
                                        <span class="seat red selectabled" data-row-id="{{ $seat->row }}" data-column-id="{{ $seat->column }}"  data-no="03010101" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>
                                    @else
                                        <span class="seat" style="background: #ffffff!important;" data-row-id="{{ $seat->row }}" data-column-id="{{ $seat->column }}" data-no="03010101" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>
                                    @endif
                                @endforeach
                                {{--<span class="seat selectable" data-column-id="2" data-row-id="1" data-no="03010102" data-st="N" data-act="seat-click" data-bid="b_s7eiiijf"></span>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="side">
                <div class="movie-info">
                    <div class="poster">
                        {{--<img src="http://p0.meituan.net/movie/a547dd7f6851d7ced67ec1b6c8b7f3b2447754.jpg@115w_158h_1e_1c">--}}
                        <img src="{{ $movie['images']['small'] }}">
                    </div>
                    <div class="content">
                        {{--<p class="name text-ellipsis">头号玩家</p>--}}
                        <p class="name text-ellipsis movie-name" data-movie-name="{{ $movie['title'] }}">{{ $movie['title'] }}</p>
                        <div class="info-item">
                            <span>类型 :</span>
                            {{--<span class="value">动作,冒险,科幻</span>--}}
                            @foreach($movie['genres'] as $genres)
                                <span class="value">{{ $genres }}</span>
                            @endforeach
                        </div>
                        <div class="info-item">
                            <span>时长 :</span>
                            <span class="value">140分钟</span>
                        </div>
                    </div>
                </div>
                <div class="show-info">

                        <div class="info-item">
                            <span>影院 :</span>
                            <span class="value text-ellipsis cinema-name" data-cinema-name="{{ (array_values(array_values($cinema['data'])[0])[0])['nm']  }}"> {{ (array_values(array_values($cinema['data'])[0])[0])['nm']  }}</span>
                        </div>
                        <div class="info-item">
                            <span>影厅 :</span>
                            <span class="value text-ellipsis screen-name" data-screen-name="{{ $screen->s_name }}">{{ $screen->s_name }}</span>
                            <span class="value text-ellipsis screen-id" data-screen-id="{{ $screen->sId }}"></span>
                        </div>
                        <div class="info-item">
                            <span>版本 :</span>
                            <span class="value text-ellipsis">英语3D</span>
                        </div>
                        <div class="info-item">
                            <span>场次 :</span>
                            <span class="value text-ellipsis screen" style="color: #ff0000;">{{ $screen->date }}&nbsp;{{ $screen->s_start }}</span>
                        </div>
                        <div class="info-item">
                            <span>票价 :</span>
                            {{--<span class="value text-ellipsis sellPrice" data-price="{{ (array_values(array_values($cinema['data'])[0])[0])['sellPrice']  }}">￥{{ (array_values(array_values($cinema['data'])[0])[0])['sellPrice']  }}/张</span>--}}
                            <span class="value text-ellipsis sellPrice" data-price="{{ $screen->price  }}">￥{{ $screen->price }}/张</span>
                        </div>

                </div>
                <div class="ticket-info">
                    <div class="no-ticket" style="display: block;">
                        <p class="buy-limit">座位：一次最多选4个座位</p>
                        <p class="no-selected">请<span>点击左侧</span>座位图选择座位</p>
                    </div>
                    <div class="has-ticket" style="display: none;">
                        <span class="text">座位：</span>
                        <div class="ticket-container" data-limit="4">
                            {{--<span class="selected">8排1座</span>--}}
                        </div>
                    </div>

                    <div class="total-price">
                        <span>总价 :</span>
                        <span class="allPrice"></span><span>元</span>
                    </div>
                </div>
                <div class="confirm-order">
                    @if(Cookie::get('username') === 'admin')
                        <button class="btn btn-info">admin无法购票</button>
                    @elseif(Cookie::has('username')  )
                        <button class="btn btn-success confirm-ticket">确认选座</button>
                    @else
                        <a href="{{ Route('log') }}" class="btn btn-danger">请登录</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{--确认选座的模态框 start--}}
    <div class="modal fade confirm-ticket-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">请付款</h4>
                </div>
                <div class="modal-body">
                    <p class="ticket-tip" style="text-align: center;font-size: 18px;">One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-success confirm-pay" data-dismiss="modal">确定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    {{--确认选座的模态框 end--}}
    <div class="seat-bg">
        <div class="seat-load">
            <img src="img/load01.gif" alt="">
            <p style="color: #eb5524;">正在购票，请稍候</p>
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            /*选座*/
            $rowArr = [];
            $columnArr = [];

            $rowArrCheck = [];
            $columnArrCheck = [];

            $('.selectable').map(function (i) {
                $i = 0;
                $sellPrice = $('.sellPrice').attr('data-price');
//                $sellPrice = 23;
                $allPrice = 0;


                /*选座的单击事件*/
                $(this).on('click',function () {
                    $row = $(this).attr('data-row-id');
                    $column = $(this).attr('data-column-id');

                    console.log($column);

                    $rowArrCheck[i] = $row;
                    $columnArrCheck[i] = $column;
                    $(this).toggleClass('green');

                    /*判断是否选中  green*/
                    $sign = ($(this).attr('class'));
                    $sign = $sign.indexOf('green');

                    $('.no-ticket').css({'display':'none'});
                    $('.has-ticket').css({'display':'block'});

//                    console.log($sign);
//                    console.log($rowArrCheck.indexOf($row));
//                    console.log($columnArrCheck.indexOf($column));
//                    console.log('___________________');
                    if($sign>0 && $rowArrCheck.indexOf($row)>0 && $columnArrCheck.indexOf($column)>0)
                    {
                            $i++;
//                            console.log($i);
                            $rowArr[$i] = $row;
                            $columnArr[$i] = $column;
                            $allPrice += parseInt($sellPrice);
                            console.log($allPrice);
                            console.log($columnArr);
                            console.log('_______________');
                            if($i>3)
                            {
                                $('.selectable').unbind();
                                alert('最多购买4张票');
                            }

                            $span = $("<span></span>").text($row+'排'+$column+'座');
                            $('.ticket-container').append($span);

                            $('.allPrice').html($allPrice);

                    }
                    else
                    {
                        $i--;
                        $('.ticket-container span:last').remove();
                            $allPrice -= parseInt($sellPrice);
                            $('.allPrice').html($allPrice);
//                    }
                    }

                })
            });

            /*付款*/
            $('.confirm-ticket').on('click',function () {
                $movieName = $('.movie-name').attr('data-movie-name');
                $cinemaName = $('.cinema-name').attr('data-cinema-name');
                $screenId = $('.screen-id').attr('data-screen-id');
                $allPrice = $('.allPrice').text();



                $('.ticket-tip').text('确认支付'+$allPrice+'元');
                $('.confirm-ticket-modal').modal('show')

                $('.confirm-pay').on('click',function () {
                    console.log($movieName,$cinemaName,$screenId,$allPrice);
//                    console.log($rowArr,$columnArr);
                    $screenWidth = $(window).width();
                    $screenHeight = $(window).height();
                    setTimeout(function () {
                        $('.seat-bg').css({'width':$screenWidth,'height':$screenHeight,'display':'block'});
                        $('.seat-load').css({'display':'block'});
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                        $.ajax({
                            url:'ticket',
                            type:'post',
                            data:{
                                  'movieName':$movieName,
                                  'cinemaName':$cinemaName,
                                  'screenId':$screenId,
                                  'allPrice':$allPrice,
                                    'rowArr':$rowArr,
                                    'columnArr':$columnArr,
                                },
                            success:function (data) {
                                setTimeout(function () {
                                    if(data = 'success')
                                    {
                                        $('.seat-bg').css({'display':'none'});
                                        $('.seat-load').css({'display':'none'});
                                        alert('购票成功');
                                        window.location.reload();

                                    }
                                    else
                                    {
                                        alert('购票失败');
                                    }
                                },2000);
                            },
                            error:function () {
//                              alert('error');
                            },
                        });
                    },1000);
                });
            });



        });
    </script>
@endsection