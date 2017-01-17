@extends('layouts.m_main_layout')
@section('meta')

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/m-index.css')}}">
@endsection

@section('category')
    @if($c_id == 1)
        <a class="differ-a" href="{{url('/')}}">홈</a>
        <a class="differ-a" href="{{url('/?c_id=1')}}">경제</a>
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