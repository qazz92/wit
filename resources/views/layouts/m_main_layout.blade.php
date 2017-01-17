<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    <title>뭔소리야</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/m-common.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div id="mySidenav" class="sidenav">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    @if (\Illuminate\Support\Facades\Auth::user() == null)
        <a class="differ" href="{{url('/register')}}">회원가입 / 로그인</a> &nbsp; &nbsp;
    @else
        <a class="differ" href="{{url('/mypage')}}" style="margin-right: 10px;">마이페이지</a>
        <a class="differ" href="{{url('/logout')}}">로그아웃</a>
    @endif
    <hr>
    @yield('category')
</div>
<!--   header 고정-->
<section>
    <nav class="navbar navbar-default" id="nav">
        <div class="container-fluid">
            <div class="container">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <span class="open" onclick="openNav()">&#9776;</span>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <a href="{{url('/')}}" class="logo"><img id="logo" src="{{asset('/assets/image/logo.png')}}" width="180"></a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <a href="javascript:void(0);" onclick="show();return false" class="glass"><img id="glass-bt" src="{{asset('assets/image/glass.png')}}"></a>
                </div>
            </div>
        </div>
        <!--            glass버튼 클릭 시 검색 창 생성-->
        <div>
            <div class="find-div">
                <input type="text" class="input-sm find-input" id="search">
                <a href="#"><img id="glass" src="{{asset('assets/image/glass.png')}}"></a>
            </div>
        </div>

    </nav>
</section>
<!--    content-->
<!-- class="con-sec" 고정  -->
<section class="con-sec" id="contain">
    <!--               페이지마다 내용 바뀜-->
    @yield('contents')
</section>
<!--    footer-->
<section>
    <div class="footer">
        <div class="container">
            <ul>
                <li><a class="top">뭔 소리야▲</a></li>
                <li>|</li>
                <li><a>광고문의</a></li>
                <li>|</li>
                <li><a>개인정보취급</a></li>
            </ul>
        </div>
    </div>
</section>

<!--   Script-->
<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/bootstrap/bootstrap.min.js")}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>

<!--       Toggle-->
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<!--    top script-->
<script>
    $(document).ready(function () {
        $('.top').click(function () {
            $('html, body').animate({
                scrollTop: 0
            }, 600);
            return false;
        });
            $( "#search" ).autocomplete({
                source : function( request, response ) {
                    $.ajax({
                        type: 'get',
                        url: "/search_keyword",
                        data: {
                            searchValue: request.term
                        },
                        success: function(data) {
                            //서버에서 json 데이터 response 후 목록에 뿌려주기 위함
                            response(
                                $.map(data, function(item) {
                                    return {
                                        label: item.title,
                                        value: item.id
                                    }
                                })
                            );
                        }
                    });
                },

                focus: function( event, ui ) {
                    $( "#search" ).val( ui.item.label );
                    event.preventDefault();
                },

                //조회를 위한 최소글자수
                minLength: 2,
                matchContains: true,
                select: function( event, ui ) {
                    // 만약 검색리스트에서 선택하였을때 선택한 데이터에 의한 이벤트발생

//                $("#attendanceInfo").append("<option value='"+ui.item.value+"'>"+ui.item.label+"</option>");


                    return false;
                },
                close: function () {

                    $(this).val('');
                }
            });
        });
</script>
<!--    find 창 나옴-->
<script type="text/javascript">
    function show() {
        if ($('.find-div').css('display') == 'none') {
            $('.find-div').slideDown();
            $('.con-sec').css('margin-top', 120);
        } else {
            $('.find-div').slideUp();
            $('.con-sec').css('margin-top', 90);
        }

    }
</script>
@yield('js')
</body>

</html>