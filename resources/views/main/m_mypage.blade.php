@extends('layouts.m_main_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/m-mypage.css')}}">
@endsection

@section('category')
    <a class="differ-a" href="{{url('/')}}">홈</a>
    <a class="differ-a" href="#">프로필</a>
    <a class="differ-a" href="#">따봉 목록</a>
    <a class="differ-a" href="#">찜 목록</a>
@endsection
@section('contents')

@endsection

<section class="con-sec">
    <div class="container">
        <div class="prof pro-wid">
            <form enctype="multipart/form-data" id="upload_form" role="form" method="POST">
                <div class="profile-image"><img id="thumbnail" src="{{url('/').'/'.$user[0]->th}}"></div>
                <input type="file" id="inputTh" name="inputTh" accept="image/*">
            </form>
        </div>
        <div class="prof">
            <h4>{{$user[0]->name}}</h4>
        </div>
        <div class="update-bt">
            <button type="button" id="up-bt" class="btn up-bt">수정</button>
        </div>
        <div class="prof-update">
            <h4 class="h4"><strong>계정정보 변경</strong></h4>
            <br>

            <span class="update-span">이메일</span>
            <input class="input email-input" type="email" id="email-update" name="email-update" placeholder="현재 이메일" disabled value="{{$user[0]->email}}">
            <br>
            <span class="update-span">닉네임</span>
            <input class="input nick-input" type="text" id="nick-update" name="nick-update" placeholder="현재 닉네임" disabled value="{{$user[0]->name}}">

            <h4 class="h4" style="margin-top:5%;"><strong>비밀번호 변경</strong></h4>
            <br>

            <span class="update-span">현재 비밀번호 입력</span>
            <input class="input pw-input" type="password" id="now-pw" name="now-pw" placeholder="현재 비밀번호">
            <br>
            <span class="update-span">새로운 비밀번호 입력</span>
            <input class="input pw-input" type="password" id="pw-update" name="pw-update" placeholder="새로운 비밀번호">
            <br>
            <span class="update-span">새로운 비밀번호 확인</span>
            <input class="input pw-input" type="password" id="pw-con" name="pw-con" placeholder="새로운 비밀번호 확인">
            <br>

            <div>
                <div class="update-button">
                    <button type="button" id="up-can" class="btn up-can">취소</button>
                    <button type="submit" class="btn up-ok" id="pwUpdateBtn">확인</button>
                </div>
            </div>
        </div>

    </div>
</section>

@section('js')

    <script type="text/javascript">
        $(function(){
            $('#up-bt').click(function(){
                $('.update-bt').hide();
                $('.prof-update').show();
            });
        });
    </script>
    <script>
        $("#pwUpdateBtn").click(function () {
            var cupw = $("#now-pw").val();
            var chpw = $("#pw-update").val();
            var chpwcon = $("#pw-con").val();
            if (cupw != '') {
                if (chpw == chpwcon){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/mypage/pwch',
                        type: "post",
                        data: {'cupw':cupw,'chpw':chpw },
                        success: function(data){
                            if (data == "ok") {
                                alert('비밀번호 변경완료!');
                                $("#now-pw").val('');
                                $("#pw-update").val('');
                                $("#pw-con").val('');
                                location.href='/logout';
                            } else {
                                alert('비밀번호 변경실패...');
                                console.log(data);
                            }
                        }
                    });
                }
                else {
                    alert("변경할 비밀번호를 다시 확인해주세요.");
                }
            } else {
                alert("현재 비밀번호를 입력 해주세요");
            }
        });
        var IMAGE_PATH = '{{url('/')}}/images/upload/thumbnail';
        $('input[name=inputTh]').change(function(ev) {
            var data = new FormData();
            data.append("thum",$('#inputTh')[0].files[0]);
            console.log($('#inputTh')[0].files[0].name);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:'/mypage/uploadThum',
                data:data,
                type:'post',
                processData: false,
                contentType: false,
                success:function(url){
                    var thum = IMAGE_PATH +"/"+ url;
                    document.querySelector('#thumbnail').src = thum;
                }
            });
        });
    </script>
@endsection
