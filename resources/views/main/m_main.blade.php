@extends('layouts.m_main_layout')
@section('meta')

@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/m-index.css')}}">
@endsection

@section('category')
    <a class="differ-a active" href="#">홈</a>
    <a class="differ-a" href="#">경제</a>
    <a class="differ-a" href="#">역사</a>
    <a class="differ-a" href="#">사회</a>
    <a class="differ-a" href="#">정치</a>
    <a class="differ-a" href="#">IT/과학</a>
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