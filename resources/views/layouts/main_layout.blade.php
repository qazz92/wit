<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>뭔소리야</title>
    @yield('meta')
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
</head>
<body>
<section>
    <nav class="navbar navbar-default" id="nav">
        <div class="container-fluid">
            <div class="container ver">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <a href="{{url('/')}}"><img id="logo" src="{{asset('/assets/image/logo.png')}}" width="180"></a>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 ver">
                    <div class="nav-find">
                        <form id="find_form">
                            <div>
                                <input type="text" class="input-lg find-input">
                                <a href="#"><img id="glass" src="{{asset('assets/image/glass.png')}}"></a>
                            </div>
                        </form>
                    </div>
                    <span class="text-right">
                        @if (\Illuminate\Support\Facades\Auth::user() == null)
                            <a class="login-a" href="{{url('/register')}}">회원가입 / 로그인</a> &nbsp; &nbsp;
                        @else
                            <a class="login-a" href="{{url('/mypage')}}" style="margin-right: 10px;">마이페이지</a>
                            <a class="login-a" href="{{url('/logout')}}">로그아웃</a>
                        @endif
                        </span>
                </div>
            </div>
        </div>
    </nav>
</section>

        @yield('contents')

<!--    footer-->
<section>
    <div class="footer">
        <div class="container">
            <ul>
                <li><a>뭔 소리야▲</a></li>
                <li>|</li>
                <li><a>광고문의</a></li>
                <li>|</li>
                <li><a>개인정보취급</a></li>
            </ul>
        </div>
    </div>
</section>
<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/bootstrap/bootstrap.min.js")}}"></script>
@yield('js')
</body>
</html>
