@extends('layouts.m_main_layout')
@section('meta')

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/m-index.css')}}">
@endsection

@section('category')
    @if($c_id == 1)
        <a class="differ-a" href="{{url('/')}}">홈</a>
        <a class="differ-a active" href="{{url('/?c_id=1')}}">경제</a>
        <a class="differ-a" href="{{url('/?c_id=2')}}">역사</a>
        <a class="differ-a" href="{{url('/?c_id=3')}}">사회</a>
        <a class="differ-a" href="{{url('/?c_id=4')}}">정치</a>
        <a class="differ-a" href="{{url('/?c_id=5')}}">IT/과학</a>
    @elseif($c_id == 2)
        <a class="differ-a" href="{{url('/')}}">홈</a>
        <a class="differ-a" href="{{url('/?c_id=1')}}">경제</a>
        <a class="differ-a active" href="{{url('/?c_id=2')}}">역사</a>
        <a class="differ-a" href="{{url('/?c_id=3')}}">사회</a>
        <a class="differ-a" href="{{url('/?c_id=4')}}">정치</a>
        <a class="differ-a" href="{{url('/?c_id=5')}}">IT/과학</a>
    @elseif($c_id == 3)
        <a class="differ-a" href="{{url('/')}}">홈</a>
        <a class="differ-a" href="{{url('/?c_id=1')}}">경제</a>
        <a class="differ-a" href="{{url('/?c_id=2')}}">역사</a>
        <a class="differ-a active" href="{{url('/?c_id=3')}}">사회</a>
        <a class="differ-a" href="{{url('/?c_id=4')}}">정치</a>
        <a class="differ-a" href="{{url('/?c_id=5')}}">IT/과학</a>
    @elseif($c_id == 4)
        <a class="differ-a" href="{{url('/')}}">홈</a>
        <a class="differ-a" href="{{url('/?c_id=1')}}">경제</a>
        <a class="differ-a" href="{{url('/?c_id=2')}}">역사</a>
        <a class="differ-a" href="{{url('/?c_id=3')}}">사회</a>
        <a class="differ-a active" href="{{url('/?c_id=4')}}">정치</a>
        <a class="differ-a" href="{{url('/?c_id=5')}}">IT/과학</a>
    @elseif($c_id == 5)
        <a class="differ-a" href="{{url('/')}}">홈</a>
        <a class="differ-a" href="{{url('/?c_id=1')}}">경제</a>
        <a class="differ-a" href="{{url('/?c_id=2')}}">역사</a>
        <a class="differ-a" href="{{url('/?c_id=3')}}">사회</a>
        <a class="differ-a" href="{{url('/?c_id=4')}}">정치</a>
        <a class="differ-a active" href="{{url('/?c_id=5')}}">IT/과학</a>
    @else
        <a class="differ-a active" href="{{url('/')}}">홈</a>
        <a class="differ-a" href="{{url('/?c_id=1')}}">경제</a>
        <a class="differ-a" href="{{url('/?c_id=2')}}">역사</a>
        <a class="differ-a" href="{{url('/?c_id=3')}}">사회</a>
        <a class="differ-a" href="{{url('/?c_id=4')}}">정치</a>
        <a class="differ-a" href="{{url('/?c_id=5')}}">IT/과학</a>
    @endif
@endsection
@section('contents')
    @foreach($contents as $content)
    <div class="col-xs-6 col-padding">
        <a href="{{url('/main/main_modal')}}/{{$content->id}}">
            <div class="card">
                <div class="image_div view overlay hm-white-slight">
                    <img class="magazine_image" src="{{$content->image}}">

                    <div class="mask"></div>

                </div>
                <div class="magazine_span_div card-block">
                    <span>{{$content->title}}</span>
                </div>
            </div>
        </a>
    </div>
    @endforeach
@endsection

@section('js')<script>//infinite Scroll Start
    var page=2;//page var
    $(window).scroll(function () {
        if  ($(window).scrollTop() >= $(document).height() - $(window).height()) { // height event
            function getQuerystring(paramName){<!-- c_id sort script-->
                var _tempUrl = window.location.search.substring(1); //url에서 처음부터 '?'까지 삭제
                var _tempArray = _tempUrl.split('&'); // '&'을 기준으로 분리하기
                if(_tempArray==""){
                    return -1;
                    console.log(_tempArray);
                }else{
                    for(var i = 0; _tempArray.length; i++) {
                        var _keyValuePair = _tempArray[i].split('='); // '=' 을 기준으로 분리하기
                        console.log(_tempArray);
                        if(_keyValuePair[0] == paramName){ // _keyValuePair[0] : 파라미터 명
                            // _keyValuePair[1] : 파라미터 값
                            return _keyValuePair[1];
                        }
                    }
                }
            }
            if(getQuerystring('c_id')==(null)){
                var c_id = -1;
            }else{
                var c_id= getQuerystring('c_id');
            }//c_id sort end
            $.ajax({ // ajax start
                    type: 'get',
                    url: "/infinite",
                    data: {
                        page: page, c_id : c_id
                    },
                    beforeSend : function(){
                        $('#loading').css("display", "block");
                    },
                    complete : function(){
                        $('#loading').css("display", "none");
                    },
                    success: function (data) {
//                                console.log(Object.keys(data.inficon.data[0]));
                        if(Object.keys(data.inficon.data).length==0) {
                            $('#end-mess').css("display", "block");
                            $('#loading').remove();
                        }else{
                            for (var i = 0; i < Object.keys(data.inficon.data).length; i++) {
                                $('#contain').append(
                                    "<div class='col-xs-6 col-padding'>"+
                                    "<a href='{{url('/main/main_modal')}}/"+data.inficon.data[i].id+"'>"+
                                    "<div class='card'>"+
                                    "<div class='image_div view overlay hm-white-slight'>"+
                                    "<img class='magazine_image' src='" + data.inficon.data[i].image + "'>"+
                                    "<div class='mask'></div>"+
                                    "</div>"+
                                    "<div class='magazine_span_div card-block'>"+
                                    "<span>" + data.inficon.data[i].title + "</span>"+
                                    "</div>"+
                                    "</div>"+
                                    "</a>"+
                                    "</div>"
                                );
                            }
                            {{--console.log("page : "+data);--}}
                                page = page + 1; //infinite page ++
                            $('[id^=modalBtn]').on('click', function(e) {
                                var id = $(this).attr("id");
                                var number = id.replace("modalBtn", "");
                                var src = "{{url('/main/main_modal')}}"+"/"+number;
                                var src_side = "{{url('/main/side_modal')}}"+"/"+number;
                                $("#main_modal"+number).attr({'src':src});
                                $("#side_modal"+number).attr({'src':src_side});
                            });
                        }
                    }
                }
            )//ajax end
        }
    });
</script>

    @endsection