<?php

namespace App\Http\Controllers;
use App\Category;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;
use Intervention\Image\ImageManagerStatic as Image;


class AdminController extends Controller
{
    public function index(){
//        $user = Auth::user();
        return view('admin.home');
    }
    public function getWrite(){
        $dbResult = Category::all();
        return view('admin.write')->with('cates',$dbResult);
    }
    public function write(Request $request){
        $title = $request->input('title');
        $body = $request->input('body');
        $cate = $request->input('cate');
        preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $body , $match);
        $pices = explode('/',$match[1][0]);
        $image = Image::make($pices[3].'/'.$pices[4].'/'.$pices[5].'/'.$pices[6])->resize(300, 150)->save(public_path('images/upload/article/thumbnail').'/'.'resize_'.$pices[6]);
        $dbResult = Content::create(array('title' => $title , 'context' => $body,'image'=>url('/').'/images/upload/article/thumbnail/'.'resize_'.$pices[6],'user_id'=>Auth::user()["id"],"category_id"=>$cate));
        $response = array ('status' => 'success','result'=>$dbResult["id"]);
        return response ()->json ($response);
    }
    public function showList(){
        $dbResult = Content::all();
        return view('admin.list')->with('lists',$dbResult);
    }
    public function uploadImg(Request $request){

        if($request->hasFile('image')){
            $filename = str_random(20).'_'.$request->file('image')->getClientOriginalName();
            $image_path = base_path() . '/public/images/upload/article/';
            $request->file('image')->move(
                $image_path, $filename
            );
            echo $filename;
        }
        else{
            echo 'Oh No! Uploading your image has failed.';
        }
    }

}
