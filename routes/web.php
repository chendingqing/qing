<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//平台
Route::domain('admin.elm.com')->namespace('Admin')->group(function () {
    //店铺分类
    Route::any('shop_category/index', "ShopCategoryController@index")->name("shop_category.index");
    Route::any('shop_category/add', "ShopCategoryController@add")->name("shop_category.add");
    Route::any('shop_category/edit/{shopCategory}', "ShopCategoryController@edit")->name("shop_category.edit");
    Route::any('shop_category/del/{shopCategory}', "ShopCategoryController@del")->name("shop_category.del");
});

//商户
Route::domain('shop.elm.com')->namespace('Shop')->group(function () {
    //商家店铺管理
    Route::any('shops/index',"ShopController@index")->name("shops.index");
    Route::any('shops/reg',"ShopController@reg")->name("shops.reg");
    Route::any('shops/edit/{shops}',"ShopController@edit")->name("shops.edit");
    Route::any('shops/del/{shops}',"ShopController@del")->name("shops.del");
   //商家管理
    Route::any('user/add', "UserController@add")->name("user.add");
    Route::any('user/index', "UserController@index")->name("user.index");
    Route::any('user/edit/{user}', "UserController@edit")->name("user.edit");
    Route::any('user/del/{user}', "UserController@del")->name("user.del");
});



