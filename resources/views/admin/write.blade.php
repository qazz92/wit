@extends('layouts.admin_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('dist/summernote.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/admin-user.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
@section('contents')
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 test">

            <input class="input" type="text" id="title" name="title" placeholder="제목을 입력해주세요." style="margin-bottom: 1%;">
            <div id="summernote"></div>

            <button id="writeBtn">저장</button>
    </div>
@endsection
@section('js')
    <script src="{{asset("dist/summernote.js")}}"></script>
    <script src="{{asset("dist/lang/summernote-ko-KR.js")}}"></script>
    <script>

$(document).ready(function() {

    $("img").addClass("img-responsive");

    var IMAGE_PATH = '{{url('/')}}/images/upload/article/';

    $('#summernote').summernote({
        height: 500,
        callbacks : {
            onImageUpload: function(image) {
//                uploadImage(image[0]);
                for (var i = image.length - 1; i >= 0; i--) {
                    uploadImage(image[i], this);
                }
            }
        }
    });
    function uploadImage(image) {
        var data = new FormData();
        data.append("image",image);
        $.ajax ({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : data,
            type: "POST",
            url: "/admin/uploadImg",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
                var image = IMAGE_PATH + url;
                $('#summernote').summernote('insertImage', image);
            },
            error: function(data) {
                console.log(data);
            }
        });
        }

    });
        $("#writeBtn").click(function () {
            var body = $('#summernote').summernote('code');
            var title = $('#title').val();
            console.log(title);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/write',
                type: "post",
                data: {'title':title,'body':body },
                success: function(data){
                    if (data.status == 'success') {
                        alert('글이 등록되었습니다.');
                        $('#title').val('');
                        $('#summernote').summernote('code', '');
                    } else {
                        console.log(data.msg);
                    }
                }
            });
        });
    </script>
@endsection