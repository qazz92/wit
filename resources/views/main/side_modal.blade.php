@extends('layouts.modal_layout')
@section('meta')

@endsection
@section('css')
    <style>
        body{
            background-color: #595959;
        }
    </style>
@endsection

@section('contents')
    <div id="modal_div3">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-header div2_header">
            <img class="users" src="http://localhost:8000/{{$cts_s[0]->th}}" width="30%" style="display:block; margin:auto;">
            <p class="test_pp">관리자</p>
            <p class="test_pp1">{{$cts_s[0]->name}}</p>
        </div>
        <div class="modal-body div2_body">
            <p>
                        <span><i class="fa fa-smile-o" style="font-size:17px; color:lightgrey;"></i>
                            조회수  </span>
                <span class="p_right">{{$cts_s[0]->count}}</span>
            </p>
            <p>
                        <span><i class="fa fa-heart" style="font-size:17px; color:lightgrey;"></i>
                            좋아요  </span>
                <span class="p_right">{{$cts_s[0]->likes}}</span>
            </p>
            <p>
                        <span><i class="fa fa-comment" style="font-size:17px; color:lightgrey;"></i>
                            댓글  </span>
                <span class="p_right">{{$reply_count}}</span>
            </p>
        </div>
        <div class="modal-footer">
            <p></p>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            $('#closeModal').click(function(){
                console.log("click!!!");
                parent.$('#myModal{{$m_id}}').modal('hide');
          });
      });
    </script>
@endsection