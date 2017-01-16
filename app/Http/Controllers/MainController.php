<?php

namespace App\Http\Controllers;

use App\Content;
use App\Reply;
use App\Reply_like;
use App\Thumb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index(){
        $contents = DB::table('contents')->select('id','title','image')->orderby('updated_at')->get();
//        print_r($contents);
       return view('main.main')->with('contents',$contents);
    }
    public function count(Request $request){
        $m_id = $request->input("m_id");
        $dbResult = Content::find($m_id);
        $dbResult->count = $dbResult["count"]+1;
        $dbResult->save();
        echo "ok";
    }
    public function main_modal($id){
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
        return view('main.main_modal')->with('cts_m',$main_modal)->with('replys',$reply)->with('m_id',$id);
    }
    public function side_modal($id){
//        $side_modal = DB::table('contents')->select('likes','count')->where('id','=',$id)->get();
        $side_modal = DB::table('contents')->leftJoin('thumb','contents.user_id','=','thumb.user_id')
            ->leftJoin('users','contents.user_id','=','users.id')
            ->select('contents.likes as likes','contents.count as count','thumb.thumbnail as th','users.name as name')
            ->where('contents.id','=',$id)->get();
        $reply_count = DB::table('reply')->where('contents_id','=',$id)->count();
        return view('main.side_modal')->with('cts_s',$side_modal)->with('m_id',$id)->with('reply_count',$reply_count);
//        print_r($side_modal);
    }
    public function mypage() {
        $user = DB::table('users')
            ->leftJoin('thumb', 'users.id', '=', 'thumb.user_id')
            ->select('users.email as email','users.name as name','thumb.thumbnail as th')
            ->where('thumb.user_id','=',Auth::user()["id"])
            ->get();
        return view('main.mypage')->with('user',$user);
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
    public function like(Request $request){
        $type = $request->input("type");
        $r_id = $request->input("r_id");
        $c_id = $request->input("c_id");

        if ($type == 1) {
            $dbResult = Reply_like::create(["user_id"=>Auth::user()["id"],"reply_id"=>$r_id,"contents_id"=>$c_id]);
            echo "ok";
        } elseif($type == 0){
            $dbResult = DB::table('reply_likes')->where('user_id','=',Auth::user()["id"])->where('reply_id','=',$r_id)->delete();
            echo "ok";
        }
    }
}
