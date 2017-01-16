@extends('layouts.admin_layout')
@section('css')

@endsection
@section('contents')
    @foreach($lists as $list)
        제목 : {{$list["title"]}}<br>
        사진 : {!!$list["context"]!!}
        <hr>
    @endforeach
@endsection
@section('js')

@endsection