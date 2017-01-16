@extends('layouts.main_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
@endsection
@section('contents')
    <section class="con-sec" id="contain">
        <div class="container parent">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-fix">
                <div class="card">
                    <div class="today">
                        <ul class="nav">
                            <li class="active" role="presentation"><a href="{{url('/')}}">홈</a></li>
                            <li role="presentation"><a href="#">경제</a></li>
                            <li role="presentation"><a href="#">역사</a></li>
                            <li role="presentation"><a href="#">사회</a></li>
                            <li role="presentation"><a href="#">정치</a></li>
                            <li role="presentation"><a href="#">IT/과학</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="best">
                        <h3 class="best-h3">BEST</h3>
                        <hr class="best-hr">
                        <p>
                            <span class="best-number">1.</span>
                            <span class="best-">베스트1</span>
                        </p>
                        <p>
                            <span class="best-number">2.</span>
                            <span class="best-">베스트2</span>
                        </p>
                        <p>
                            <span class="best-number">3.</span>
                            <span class="best-">베스트3</span>
                        </p>
                        <p>
                            <span class="best-number">4.</span>
                            <span class="best-">베스트5</span>
                        </p>
                        <p>
                            <span class="best-number">5.</span>
                            <span class="best-">베스트5</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 test" >
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
        $('[id^=modalBtn]').on('click', function(e) {
            var id = $(this).attr("id");
            var number = id.replace("modalBtn", "");
            var src = "/main/main_modal/"+number+"?random="+(new Date()).getTime() + Math.floor(Math.random() * 1000000);;
            var src_side = "/main/side_modal/"+number+"?random="+(new Date()).getTime() + Math.floor(Math.random() * 1000000);;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : "POST",
                url : "/main/count",
                data: {"m_id":number},
                cache: false,
                error : function(){
                    alert('통신 실패!!');
                },
                success : function(data){
                    if(data == "ok"){
                        $("#main_modal"+number).attr({'src':src});
                        $("#side_modal"+number).attr({'src':src_side});
                    }else {
                        alert("에러가 발생하였습니다. 잠시후 다시 시도하여 주십시오.");
                    }
                }
            });
        });
    </script>
    <script src="{{asset('assets/js/best.js')}}"></script>
@endsection