@extends('layouts.modal_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/scrollbar.css')}}">
@endsection
@section('contents')
<div class="modal-header">
    <h2 class="modal-title" id="myModalLabel">{{$cts_m[0]->title}}</h2>
    <p id="test_time">{{$cts_m[0]->updated_at}}</p>
</div>

<div class="modal-body">
    <div style="width:400px; margin:auto;">
        <h3 class="test_h4" id="test_start"><strong>{{$cts_m[0]->title}}</strong></h3>
        <div class="test_div">
            {!! $cts_m[0]->context !!}
        </div>
        <!-- 좋아요 / 찜 -->
        {{--<div class='modal_like'>--}}
            {{--<a id="modal_like_a" class='modal_like_a modal_space' onclick="modal_like_a();"><i class='fa fa-heart' style='font-size:17px;'></i>--}}
                {{--따봉 </a>--}}
            {{--<a id="modal_dislike_a" class='modal_like_a_dis modal_space' onclick="modal_dislike_a();"><i class='fa fa-heart' style='font-size:17px;'></i>--}}
                {{--따봉 </a>--}}

            {{--<a id="modal_zz_a" class='modal_like_a' onclick="modal_zz_a();"><i class="fa fa-gift" style='font-size:17px;'></i>--}}
                {{--찜 </a>--}}
            {{--<a id="modal_diszz_a" class='modal_like_a_dis' onclick="modal_diszz_a();"><i class="fa fa-gift" style='font-size:17px;'></i>--}}
                {{--찜 </a>--}}
        {{--</div>--}}

    <!-- 좋아요 / 찜 박민규꺼-->
        <div class='modal_like' id="modal_like">
            @if($check_like != "1")
                <a id="modal_like_a" class='modal_like_a modal_space' onclick="like()"><i class='fa fa-heart' style='font-size:17px;'></i>
                    따봉 </a>
            @else
                <a id="modal_dislike_a" class='modal_like_a_dis modal_space' onclick="dislike()"><i class='fa fa-heart' style='font-size:17px;'></i>
                    따봉 </a>
            @endif
            @if($check_pin != "1")
                <a id="modal_zz_a" class='modal_like_a' onclick="zzim()"><i class="fa fa-gift" style='font-size:17px;'></i>
                    찜 </a>
            @else
                <a id="modal_diszz_a" class='modal_like_a_dis' onclick="diszzim()"><i class="fa fa-gift" style='font-size:17px;'></i>
                    찜 </a>
            @endif
        </div>
    </div>
</div>


<!--                       댓글 입력창-->
<form>
    <div class="modal_magazine_review">
        <div class="magazine_review">
            <!-- <div class="modal_btngroup"> -->
            <!-- <a id="modal_select1" class='modal_dat' onclick="radio_select1();">아하 </a>
            <a id="modal_select2" class='modal_dat' onclick="radio_select2();">음 </a>
            <a id="modal_select3" class='modal_dat' onclick="radio_select3();">뭔솔 </a> -->

            <div class="radio">
                <label class="radio_left" onclick="modal_aha();">
                    <input type="radio" name="radio" value="aha" checked="checked" />아하</label>
                <label class="radio_left" onclick="modal_umm();">
                    <input type="radio" name="radio" value="umm" />음</label>
                <label class="radio_left" onclick="modal_what();">
                    <input type="radio" name="radio" value="what" />뭔솔</label>
            </div>
            <!-- </div> -->


            <!-- <button class="btn btn-default btn_select" type="button" onclick="radio_select1();">아하</button>
            <button class="btn btn-default btn_select" type="button" onclick="radio_select2();">음</button>
            <button class="btn btn-default btn_select" type="button" onclick="radio_select3();">뭔솔</button> -->
            <div class="row">
                <div class="col-xs-12 review_padding">
                    <div class="row">
                        @if(\Illuminate\Support\Facades\Auth::user() != null)
                        <div class="col-xs-10" id="review_padding">
                            <textarea id="review_area" rows="4"></textarea>
                        </div>
                        <div class="col-xs-2 review_padding">
                            <button id="review_bt" class="review_bt_style" type="submit">댓글 등록</button>
                        </div>
                        @else
                            <div class="col-xs-10" id="review_padding">
                                <textarea id="review_area" rows="4" readonly>로그인이 필요합니다</textarea>
                            </div>
                            <div class="col-xs-2 review_padding">
                                <button id="loginBtn" class="review_bt_style" type="button" onclick="loginBtn()">로그인</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!--        댓글 -->
<div class="modal_magazine_review1" id="reply_div">
    <div class="magazine_review1">
        @foreach($replys as $reply)
            <div class="row row_line">
                <div class="col-xs-1 review_padding">
                    <img class="users" src="http://localhost:8000/{{$reply->th}}" width="70%" height="70%">
                </div>
                <div class="col-xs-11 review_padding">
                    <div class="review_span_bottom">
                        <span class="review_nik"><strong>{{$reply->name}}</strong>
                            @if($reply->r_t==="aha")
                                <span style="color: #617df6";>(아하!)</span>
                            @elseif($reply->r_t==="umm")
                                <span style="color: #f6cb61";>(음...)</span>
                            @else
                                <span style="color: #f66161";>(뭔솔?)</span>
                            @endif
                        </span>
                        <br>
                    </div>
                    <div class="review_span_bottom">
                        <span class="review_con">{{$reply->r_c}}</span>
                        <br>
                    </div>
                    <span class="review_time">
                        <i class="fa fa-clock-o" style="font-size:15px;color:lightgrey"></i>
                        {{$reply->r_up}}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">

    function modal_aha() {
        document.getElementById('review_bt').style.background = "#617df6";
    }

    function modal_umm() {
        document.getElementById('review_bt').style.background = "#f6cb61";
    }

    function modal_what() {
        document.getElementById('review_bt').style.background = "#f66161";
    }

    function modal_like_a() {
        document.getElementById('modal_like_a').style.display = "none";
        document.getElementById('modal_dislike_a').style.display = "inline";
    }

    function modal_dislike_a() {
        document.getElementById('modal_dislike_a').style.display = "none";
        document.getElementById('modal_like_a').style.display = "inline";
    }

    function modal_zz_a() {
        document.getElementById('modal_zz_a').style.display = "none";
        document.getElementById('modal_diszz_a').style.display = "inline";
    }

    function modal_diszz_a() {
        document.getElementById('modal_diszz_a').style.display = "none";
        document.getElementById('modal_zz_a').style.display = "inline";
    }
    $("#loginBtn").click(function () {
        window.open("{{url('/login')}}",'_parent');
    });
    {{--$("#review_bt").click(function () {--}}
        {{--var body = $('#review_area').val();--}}
        {{--var radio = $(':radio[name="radio"]:checked').val();--}}

        {{--if (body == '' ){--}}
            {{--alert("내용을 입력해주세요");--}}
        {{--} else if (typeof radio === "undefined"){--}}
            {{--alert("타입을 선택해주세요");--}}
        {{--} else {--}}
            {{--$.ajax({--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--url: '/main/reply',--}}
                {{--type: "post",--}}
                {{--data: {'body':body, 'type':radio, 'm_id':"{{$m_id}}"},--}}
                {{--success: function(data){--}}
                    {{--if (data.msg == 'ok') {--}}
                        {{--alert("OK!!");--}}
                        {{--console.log(data.result_body.type);--}}
                        {{--$("#reply_div").load(window.location.href+" #reply_div");--}}
{{--//                        parent.frames.left.location.reload();--}}
                    {{--} else {--}}
                        {{--console.log(data);--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}
    {{--});--}}

    //박민규꺼
        $("#review_bt").click(function () {
        var body = $('#review_area').val();
        var radio = $(':radio[name="radio"]:checked').val();
        var string = document.getElementById("review_area").value;
        if (body == '' ) {
            alert("내용을 입력해주세요");
        } else if (getStringLength(string)>240){
            alert("한글 120자 / 영어 240자를 초과할 수 없습니다.");
        } else if (typeof radio === "undefined"){
            alert("타입을 선택해주세요");
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/main/reply',
                type: "post",
                data: {'body':body, 'type':radio, 'm_id':"{{$m_id}}"},
                success: function(data){
                    if (data.msg == 'ok') {
                        alert("OK!!");
                        console.log(data.result_body.type);
                        $("#reply_div").load(window.location.href+" #reply_div");
//                        parent.frames.left.location.reload();
                    } else {
                        console.log(data);
                    }
                }
            });
        }
    });

    // 문자열 길이 체크 알파뉴메릭(1자리), 한글(2자리)
    function getStringLength (str){
        var retCode = 0;
        var strLength = 0;
        for (i = 0; i < str.length; i++)
        {
            var code = str.charCodeAt(i)
            var ch = str.substr(i,1).toUpperCase()
            code = parseInt(code)
            if ((ch < "0" || ch > "9") && (ch < "A" || ch > "Z") && ((code > 255) || (code < 0)))
                strLength = strLength + 2;
            else
                strLength = strLength + 1;
        }
        return strLength;
    }
    function like() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/like',
            type: "post",
            cache: false,
            data: {"content_id":"{{$cts_m[0]->id}}"},
            success: function(data){
                if (data) {
                    alert("좋아요!");
                    $("#modal_like").load(window.location.href+" #modal_like");
                } else {
                    console.log(data);
                }
            }
        });
    }
    function dislike() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/dislike',
            type: "post",
            cache: false,
            data: {"content_id":"{{$cts_m[0]->id}}"},
            success: function(data){
                if (data) {
                    alert("좋아요 취소되었습니다.");
                    $("#modal_like").load(window.location.href+" #modal_like");
                } else {
                    console.log(data);
                }
            }
        });
    }
    function zzim(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/zzim',
            type: "post",
            data: {"content_id":"{{$cts_m[0]->id}}"},
            success: function(data){
                if (data) {
                    alert("찜 되었습니다.");
                    $("#modal_like").load(window.location.href+" #modal_like");
                } else {
                    console.log(data);
                }
            }
        });
    }
    function diszzim(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/diszzim',
            type: "post",
            data: {"content_id":"{{$cts_m[0]->id}}"},
            success: function(data){
                if (data) {
                    alert("찜 취소되었습니다.");
                    $("#modal_like").load(window.location.href+" #modal_like");
                } else {
                    console.log(data);
                }
            }
        });
    }
</script>
@endsection