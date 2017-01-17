@extends('layouts.main_layout')
@section('meta')

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
@endsection
@section('contents')
    <section class="con-sec" id="contain">
        <div class="container parent">
            <div id="fix" class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-fix">
                <div class="card">
                    <div class="today">
                        <ul class="nav">
                            @if($c_id == 1)
                                <li class="" role="presentation"><a href="{{url('/')}}">홈</a></li>
                                <li class="active" role="presentation"><a href="{{url('/?c_id=1')}}">경제</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=2')}}">역사</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=3')}}">사회</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=4')}}">정치</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=5')}}">IT/과학</a></li>
                            @elseif($c_id == 2)
                                <li class="a" role="presentation"><a href="{{url('/')}}">홈</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=1')}}">경제</a></li>
                                <li class="active" role="presentation"><a href="{{url('/?c_id=2')}}">역사</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=3')}}">사회</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=4')}}">정치</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=5')}}">IT/과학</a></li>
                            @elseif($c_id == 3)
                                <li class="" role="presentation"><a href="{{url('/')}}">홈</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=1')}}">경제</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=2')}}">역사</a></li>
                                <li class="active" role="presentation"><a href="{{url('/?c_id=3')}}">사회</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=4')}}">정치</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=5')}}">IT/과학</a></li>
                            @elseif($c_id == 4)
                                <li class="" role="presentation"><a href="{{url('/')}}">홈</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=1')}}">경제</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=2')}}">역사</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=3')}}">사회</a></li>
                                <li class="active" role="presentation"><a href="{{url('/?c_id=4')}}">정치</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=5')}}">IT/과학</a></li>
                            @elseif($c_id == 5)
                                <li class="" role="presentation"><a href="{{url('/')}}">홈</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=1')}}">경제</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=2')}}">역사</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=3')}}">사회</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=4')}}">정치</a></li>
                                <li class="active" role="presentation"><a href="{{url('/?c_id=5')}}">IT/과학</a></li>
                            @else
                                <li class="active" role="presentation"><a href="{{url('/')}}">홈</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=1')}}">경제</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=2')}}">역사</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=3')}}">사회</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=4')}}">정치</a></li>
                                <li class="" role="presentation"><a href="{{url('/?c_id=5')}}">IT/과학</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
                <div class="card" id="best_div">
                    <div class="best">
                        <h3 class="best-h3">BEST</h3>
                        <hr class="best-hr">
                        @foreach($bests as $best)
                        <p>
                            <span class="best-number">{{$loop->iteration}}</span>
                            <span class="best-" data-toggle="modal" data-target="#best{{$best->id}}" id="bestModal{{$best->id}}">{{$best->title}}</span>
                        </p>
                            <!--    Modal-->
                            <!-- Content Modal1 -->
                            <div class="modal fade" id="best{{$best->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <!-- 1단락 -->
                                        <iframe id="best_main_modal{{$best->id}}" class="modal_div1" src="" width="73%" height="750" frameborder="no">
                                        </iframe>
                                        <!--                   2단락 -->
                                        <iframe id="best_side_modal{{$best->id}}" class="modal_div2" src="" width="27%" height="750" frameborder="no" scrollbar="no" allowtransparency="true" >
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
         <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 test">
         @foreach($contents as $content)

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6 col-padding" id="modalBtn{{$content->id}}" data-toggle="modal" data-target="#myModal{{$content->id}}" onclick="modal_resize();">
            <div class="card">
                <div class="image_div view overlay hm-white-slight">
                    <img class="magazine_image" src="{{$content->image}}">
                    <a href="#">
                        <div class="mask"></div>
                    </a>
                </div>
                <div class="magazine_span_div card-block">
                    <span>{{$content->title}}</span>
                </div>
            </div>
        </div>
                    <!--    Modal-->
                    <!-- Content Modal1 -->
                    <div class="modal fade" id="myModal{{$content->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!-- 1단락 -->
                                <iframe id="main_modal{{$content->id}}" class="modal_div1" src="" width="73%" height="750" frameborder="no">
                                </iframe>
                                <!--                   2단락 -->
                                <iframe id="side_modal{{$content->id}}" class="modal_div2" src="" width="27%" height="750" frameborder="no" scrollbar="no" allowtransparency="true" >
                                </iframe>
                            </div>
                        </div>
                    </div>


    @endforeach
        </div>
        </div>
    </section>

@endsection
@section('js')

    <script>
        $(document).ready(function() {
            setInterval("best()", 3600000); // 매 5000ms(5초)가 지날 때마다 ozit_timer_test() 함수를 실행합니다.
            $('.best-').click(function(){
                $('#fix').removeClass('col-fix');
            });
        });
        function best() {
            $("#best_div").load(window.location.href+" #best_div");
        }
        $('[id^=modalBtn]').on('click', function(e) {
            var id = $(this).attr("id");
            var number = id.replace("modalBtn", "");
            var src = "{{url('/main/main_modal')}}"+"/"+number;
            var src_side = "{{url('/main/side_modal')}}"+"/"+number;

            $("#main_modal"+number).attr({'src':src});
            $("#side_modal"+number).attr({'src':src_side});
        });
        $('[id^=bestModal]').on('click', function(e) {
            var id = $(this).attr("id");
            var number = id.replace("bestModal", "");
            var src = "{{url('/main/main_modal')}}"+"/"+number;
            var src_side = "{{url('/main/side_modal')}}"+"/"+number;

            $("#best_main_modal"+number).attr({'src':src});
            $("#best_side_modal"+number).attr({'src':src_side});
        });
        $(document).on("hidden.bs.modal", function (e) {
            $('#fix').addClass('col-fix');
        });
    </script>
@endsection