<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/m-join.css')}}">
    <title>회원가입</title>
</head>

<body>
<div id="main">
    <div style="width:80%; margin:auto;">
        <button class="lightGrey" id="login_btn" type="button">로그인</button>
    </div>
    <div id="reg">
        <div id="reg_r">
            <div class="outer">
                <div class="inner">
                    <div class="centered">
                        <strong>WELCOME</strong>
                        <h2 style="padding-bottom:5%;">뭔소리야</h2>
                        <form role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input class="input" type="email" name="email" id="email" placeholder="이메일" value="{{ old('email') }}" required style="margin-bottom:2%;">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="input" type="password" name="password" id="password" placeholder="비밀번호" value="" style="margin-bottom:2%;" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input class="input" type="password" name="password_confirmation" id="password-confirm" placeholder="비밀번호 확인" style="margin-bottom:2%;" required>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input class="input" type="text" name="name" id="name" placeholder="닉네임" value="{{ old('name') }}" required autofocus style="margin-bottom:2%;">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> --}}
                            {{--<input class="input" type="text" name="name" id="name" placeholder="닉네임" value="{{ old('name') }}" required autofocus style="margin-bottom:2%;">--}}
                            {{--@if ($errors->has('name')) --}}
                            {{--<span class="help-block"> --}}
                            {{--<strong>{{ $errors->first('name') }}</strong> --}}
                            {{--</span> --}}
                            {{--@endif--}}
                            {{--</div> --}}
                            <div class="form-group">
                                <button type="button" name="cancel" id="cancel" class="btn btn1" onclick="location.href='index.html'">취소</button>
                                <button type="submit" class="btn btn1" id="reg_btn">
                                    회원가입
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/bootstrap/bootstrap.min.js")}}"></script>
<script type="text/javascript">
    $("#login_btn").click(function () {
        window.location.href = "login"
    });
</script>

</body>

</html>