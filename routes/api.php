<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//api路由
Route::get('/shop/list', "api\ShopController@list")->name("shop.list");
Route::get('/shop/index', "api\ShopController@index")->name("shop.index");


Route::any('/member/reg', "api\MemberController@reg")->name("member.reg");
Route::any('/member/sms', "api\MemberController@sms")->name("member.sms");
Route::any('/member/login', "api\MemberController@login")->name("member.login");
Route::any('/member/remember', "api\MemberController@remember")->name("member.remember");
Route::any('/member/update', "api\MemberController@update")->name("member.update");
