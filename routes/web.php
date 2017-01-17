<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'MainController@index');

Route::get('/infinite','MainController@infiniteScroll');

Route::post('/main/reply/like','MainController@like')->middleware('auth');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::post('/main/count','MainController@count');

Route::get('/search_keyword','MainController@keyword');

Route::get('/main/main_modal/{id}','MainController@main_modal')->middleware('nocache');

Route::get('/main/side_modal/{id}','MainController@side_modal')->middleware('nocache');

Route::post('/main/reply','MainController@reply')->middleware('auth');

Route::get('/mypage','MainController@mypage')->middleware('auth');

Route::post('/admin/uploadThum','AdminController@uploadThum')->middleware('auth','admin');

Route::post('/mypage/uploadThum','MainController@uploadThum')->middleware('auth');

Route::post('/mypage/pwch','MainController@pwch')->middleware('auth');

Route::get('/admin','AdminController@index')->middleware('auth','admin');

Route::get('/admin/write','AdminController@getWrite')->middleware('auth','admin');

Route::post('/admin/write','AdminController@write')->middleware('auth','admin');

Route::post('/admin/uploadImg','AdminController@uploadImg')->middleware('auth','admin');

Route::get('/admin/list','AdminController@showList')->middleware('auth','admin');

Auth::routes();

Route::get('/home', 'HomeController@index');


//박민규꺼
Route::post('/like','MainController@like');

Route::post('/dislike','MainController@dislike');

Route::post('/zzim','MainController@zzim');

Route::post('/diszzim','MainController@diszzim');