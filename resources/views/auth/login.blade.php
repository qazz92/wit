@extends('layouts.auth_layout')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
@endsection

@section('contents')
    <div id="main">
        <div id="login">
            <div id="login_top" style="background-color:#fff">
                <div class="outer">
                    <div class="inner">
                        <div class="centered">
                            <h6><strong>WELCOME</strong></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div id="login_bot">
                <div class="outer">
                    <div class="inner">
                        <div class="centered">
                            <h3 style="padding-bottom:5%;"><strong>로그인</strong></h3>
                            <form role="form" method="POST" action="{{ url('/login') }}">
                                {{csrf_field()}}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input class="input" type="email" name="email" id="email" placeholder="이메일" value="{{ old('email') }}" style="margin-bottom:2%;" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input class="input" type="password" name="password" id="password" placeholder="비밀번호" style="margin-bottom:2%;" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                            </label>
                                        </div>

                                </div>

                                <div class="form-group">
                                        <button type="button" name="cancle-bt" id="cancle-bt" class="btn btn1">취소</button>
                                        <button type="submit" name="login-bt" id="login-bt" class="btn btn1">로그인</button>

                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                            Forgot Your Password?
                                        </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection