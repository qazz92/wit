<?php

namespace App\Http\Controllers;

use App\Content;
use App\Reply;
use App\Content_likes;
use App\Content_pin;
use App\Reply_like;
use App\Thumb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Debugbar;

class MainController extends Controller
{

    public function index(Request $request){
        $agent = new Agent();
        $c_id = $request->input('c_id');
        Log::info("id : ".$c_id);
        if ($c_id == null){
            $c_id = 0;
            $contents = DB::table('contents')->select('id','title','image')->orderby('id','desc')->paginate(12);
        } else {
            $contents = DB::table('contents')->select('id','title','image')->where('category_id','=',$c_id)->orderby('id','desc')->paginate(12);
        }
        $bests = DB::table('contents')->select('id','title')->orderby('count','desc')->limit(5)->get();
        if ( $agent->isMobile() ) {
            return view('main.m_main')->with('contents',$contents)->with('c_id',$c_id);
        } else {
            return view('main.main')->with('contents',$contents)->with('bests',$bests)->with('c_id',$c_id);
        }

    }
    public function infiniteScroll(Request $request){
        $page = $request->input('page');
        $c_id = $request->input('c_id');
        if ($c_id == -1){
            $inficon = DB::table('contents')->select('id','title','image')->orderby('id','desc')->paginate(12);
        } else {
            $inficon = DB::table('contents')->select('id','title','image')->where('category_id','=',$c_id)->orderby('id','desc')->paginate(12);
        }
        $resultArr = array('page'=>$page,'inficon'=>$inficon);
        return $resultArr;
    }
    public function count(Request $request){
        $m_id = $request->input("m_id");
        $dbResult = Content::find($m_id);
        $dbResult->count = $dbResult["count"]+1;
        $dbResult->save();
        echo "ok";
    }
    public function main_modal($id){
        $agent = new Agent();
        $main_modal = DB::table('contents')
            ->select('id','title','context','updated_at')
            ->where('id','=',$id)
            ->get();
        $reply = DB::table('reply')
            ->leftJoin('thumb','reply.user_id','=','thumb.user_id')
            ->leftJoin('users','users.id','=','reply.user_id')
            ->select('reply.id as r_id','reply.context as r_c','reply.type as r_t','reply.likes as r_l','reply.updated_at as r_up','thumb.thumbnail as th','users.name as name')
            ->where('reply.contents_id','=',$id)
            ->orderby('reply.updated_at','desc')
            ->get();

    //pmk
        $getUserId = Auth::user()["id"];
        $islikesnull = DB::table('content_likes')->select('id')->where('user_id','=',$getUserId)->where('content_id','=',$id)->get();
        $ispinnull = DB::table('content_pin')->select('id')->where('user_id','=',$getUserId)->where('content_id','=',$id)->get();
        if(count($islikesnull->toArray())==0){
            $check_like = 0;
        }else{
            $check_like = 1;
        }
        if(count($ispinnull->toArray())==0){
            $check_pin = 0;
        }else{
            $check_pin = 1;
        }

        if ( $agent->isMobile() ) {
//            return view('main.m_modal')->with('cts_m',$main_modal)->with('replys',$reply)->with('m_id',$id);
            return view('main.m_modal')->with('cts_m',$main_modal)->with('replys',$reply)->with('m_id',$id)->with('check_like',$check_like)->with('check_pin',$check_pin);
        } else {
//            return view('main.main_modal')->with('cts_m',$main_modal)->with('replys',$reply)->with('m_id',$id);
            return view('main.main_modal')->with('cts_m',$main_modal)->with('replys',$reply)->with('m_id',$id)->with('check_like',$check_like)->with('check_pin',$check_pin);
        }
    }
    public function side_modal($id){
        $side_modal = DB::table('contents')->leftJoin('thumb','contents.user_id','=','thumb.user_id')
            ->leftJoin('users','contents.user_id','=','users.id')
            ->select('contents.count as count','thumb.thumbnail as th','users.name as name')
            ->where('contents.id','=',$id)->get();
        $likes = DB::table('content_likes')->where('content_id','=',$id)->count();
        $reply_count = DB::table('reply')->where('contents_id','=',$id)->count();
        return view('main.side_modal')->with('cts_s',$side_modal)->with('likes',$likes)->with('m_id',$id)->with('reply_count',$reply_count);
//        print_r($side_modal);
    }
    public function mypage() {
        $agent = new Agent();
        $user = DB::table('users')
            ->leftJoin('thumb', 'users.id', '=', 'thumb.user_id')
            ->select('users.email as email','users.name as name','thumb.thumbnail as th')
            ->where('thumb.user_id','=',Auth::user()["id"])
            ->get();
        if ( $agent->isMobile() ) {
            return view('main.m_mypage')->with('user',$user);
        } else {
            return view('main.mypage')->with('user',$user);
        }
    }
    public function pwch(Request $request){
        $cupw = $request->input('cupw');
        $chpw = $request->input('chpw');
        $selectPW = DB::table('users')->select('password')->where('id','=',Auth::user()["id"])->get();
        $hashedPassword = $selectPW[0]->password;
        if (Hash::check(trim($cupw), $hashedPassword)) {
            $request->user()->fill([
                'password' => Hash::make($chpw)
            ])->save();
            echo "ok";
        }else {
            echo "no";
        }

    }
    public function uploadThum(Request $request){

        if($request->hasFile('thum')){
            $filename = Auth::user()["email"].'_'.$request->file('thum')->getClientOriginalName();
            $image = Image::make($request->file('thum'))->resize(120, 120)->save(public_path('images/upload/thumbnail').'/'.$filename);
            $check = DB::table('thumb')->where('user_id','=',Auth::user()["id"])->get();
            if ($check == null){
                $dbResult = Thumb::create(array('thumbnail'=>'images/upload/thumbnail/'.$filename,'user_id'=>Auth::user()["id"]));
                Log::info("create start!");
                echo $filename;
            } else {
                $dbResult = DB::table('thumb')->where('user_id','=',Auth::user()["id"])->update(['thumbnail'=>'images/upload/thumbnail/'.$filename]);
                Log::info("update start!");
                echo $filename;
            }
        }
        else{
            echo 1;
        }
    }
    public function reply(Request $request){
        $body = $request->input("body");
        $type = $request->input("type");
        $m_id = $request->input("m_id");

        $dbResult = Reply::create(["context"=>$body,"type"=>$type,"user_id"=>Auth::user()["id"],"contents_id"=>$m_id]);

        $result = array("result_body"=>$dbResult,"msg"=>"ok");

        return response()->json($result);

    }
//    public function like(Request $request){
//        $type = $request->input("type");
//        $r_id = $request->input("r_id");
//        $c_id = $request->input("c_id");
//
//        if ($type == 1) {
//            $dbResult = Reply_like::create(["user_id"=>Auth::user()["id"],"reply_id"=>$r_id,"contents_id"=>$c_id]);
//            echo "ok";
//        } elseif($type == 0){
//            $dbResult = DB::table('reply_likes')->where('user_id','=',Auth::user()["id"])->where('reply_id','=',$r_id)->delete();
//            echo "ok";
//        }
//    }

    public function keyword(Request $request){
        $searchValue = $request->input("searchValue");
        $dbResult = DB::table('contents')->select('id','title')->where('title', 'like', $searchValue."%")->get();
//        $result = array("msg"=>"ok","keyword"=>$dbResult);
        return $dbResult;
    }






    //박민규
    public function like(Request $request){
        $getUserId = Auth::user()["id"];
        $getContentId = $request->input("content_id");
        $dbResult = Content_likes::create(array('user_id'=>$getUserId,'content_id'=>$getContentId,'like'=>1,'check'=>1));
        echo "ok";
    }
    public function dislike(Request $request){
        $getUserId = Auth::user()["id"];
        $getContentId = $request->input("content_id");
        $dbResult = DB::table('content_likes')->where('user_id','=',$getUserId)->where('content_id','=',$getContentId)->delete();
        echo "ok";
    }
    public function zzim(Request $request){
        $getUserId = Auth::user()["id"];
        $getContentId = $request->input("content_id");
        $dbResult = Content_pin::create(array('user_id'=>$getUserId,'content_id'=>$getContentId));
        echo "ok";
    }
    public function diszzim(Request $request){
        $getUserId = Auth::user()["id"];
        $getContentId = $request->input("content_id");
        $dbResult = DB::table('content_pin')->where('user_id','=',$getUserId)->where('content_id','=',$getContentId)->delete();
        echo "ok";
    }
}
