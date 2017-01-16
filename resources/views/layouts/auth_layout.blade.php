<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    @yield('css')
    <title>뭔소리야</title>
</head>
<body>
@yield('contents')
<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/bootstrap/bootstrap.min.js")}}"></script>
@yield('js')
</body>
</html>
