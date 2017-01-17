@extends('layouts.admin_layout')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
@endsection
@section('contents')
<section>
    <div class="container">
        <p class="text-right"><a class="login-a" href="{{url('/logout')}}">로그아웃</a></p>
        <a href="{{url('/admin')}}"><img id="logo" src="{{asset('assets/image/logo.png')}}" width="200"></a>
    </div>
</section>
<section>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="container">
                <ul class="nav">
                    <li role="presentation"><a href="admin-index.html">홈</a></li>
                    <li class="active" role="presentation"><a href="admin-write.html">글쓰기</a></li>
                    <li role="presentaiton"><a href="admin-user.html">User</a></li>
                </ul>
                <div class="nav-find">
                    <form id="find_form">
                        <div>
                            <input type="text" class="input-lg find-input">
                            <a href="#"><img id="glass" src="assets/image/glass.png"></a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </nav>
</section>
<section class="con-sec">
    <div class="container">
        <form>
            <input class="input" type="text" id="title" name="title" placeholder="제목을 입력해주세요.">
        </form>
    </div>
</section>
@endsection