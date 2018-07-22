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
    //平台店铺管理
    Route::any('shop/index', "ShopController@index")->name("shop.index");
    Route::any('shop/add', "ShopController@add")->name("shop.add");
    Route::any('shop/edit/{shop}', "ShopController@edit")->name("shop.edit");
    Route::any('shop/del/{shop}', "ShopController@del")->name("shop.del");
    Route::any('shop/change/{shop}', "ShopController@change")->name("shop.change");
    //平台管理员
    Route::any('admin/index', "AdminController@index")->name("admin.index");
    Route::any('admin/add', "AdminController@add")->name("admin.add");
    Route::any('admin/edit/{admin}', "AdminController@edit")->name("admin.edit");
    Route::any('admin/del/{admin}', "AdminController@del")->name("admin.del");
    Route::any('admin/login', "AdminController@login")->name("admin.login");
    Route::any('admin/logout', "AdminController@logout")->name("admin.logout");
    Route::any('admin/update/{admin}', "AdminController@update")->name("admin.update");
    Route::any('admin/userIndex', "AdminController@userIndex")->name("admin.userIndex");
    Route::any('admin/modify/{admin}', "AdminController@modify")->name("admin.modify");

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
    Route::any('user/login', "UserController@login")->name("user.login");
    Route::any('user/logout', "UserController@logout")->name("user.logout");

});



