<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin-user.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
    <title>Admin</title>
</head>
<body>
<section>
    <nav class="navbar navbar-default" id="nav">
        <div class="container-fluid">
            <div class="container ver">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <a href="{{asset('/')}}"><img id="logo" src="{{asset('assets/image/logo.png')}}" width="180"></a>
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
                                <a class="login-a" href="{{url('/logout')}}">로그아웃</a> &nbsp; &nbsp;
                                <a class="login-a" href="{{url('/mypage')}}">마이페이지</a>
                            </span>
                </div>
            </div>

        </div>
    </nav>
</section>
<section class="con-sec" id="contain">
    <div class="container parent">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-fix">
            <div class="card">
                <div class="today">
                    <ul class="nav">
                        <li role="presentation"><a href="{{url('/')}}">홈</a></li>
                        <li class="active" role="presentation"><a href="{{url('/admin/write')}}">글쓰기</a></li>
                        <li role="presentation"><a href="{{url('/admin/user')}}">User</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @yield('contents')
    </div>
</section>
 <script src="{{asset("assets/js/jquery.min.js")}}"></script>
 <script src="{{asset("assets/bootstrap/bootstrap.min.js")}}"></script>
 @yield('js')
</body>
</html>
