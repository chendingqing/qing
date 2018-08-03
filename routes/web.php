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
    Route::any('shop_category/upload', "ShopCategoryController@upload")->name("shop_category.upload");
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
    //平台活动管理
    Route::any('activity/edit/{activity}', "ActivityController@edit")->name("activity.edit");
    Route::any('activity/index', "ActivityController@index")->name("activity.index");
    Route::any('activity/add', "ActivityController@add")->name("activity.add");
    Route::any('activity/del/{activity}', "ActivityController@del")->name("activity.del");

    //订单管理
     Route::any('order/index', "OrderController@index")->name("orders.index");
     Route::any('order/day', "OrderController@day")->name("orders.day");
     Route::any('order/moth', "OrderController@moth")->name("orders.moth");
     //菜品订单点击量
    Route::any('order/cartDay', "OrderController@cartDay")->name("orders.cartDay");
    Route::any('order/cartAll', "OrderController@cartAll")->name("orders.cartAll");
    Route::any('order/cartMoth', "OrderController@cartMoth")->name("orders.cartMoth");

    //会员管理
    Route::any('Member/index', "MemberController@index")->name("member.index");
    Route::any('Member/fill/{member}', "MemberController@fill")->name("member.fill");
    Route::any('Member/change/{member}', "MemberController@change")->name("member.change");
    Route::any('Member/find/{member}', "MemberController@find")->name("member.find");



});

//商户
Route::domain('shop.elm.com')->namespace('Shop')->group(function () {
    //默认首页
    Route::any('shops/defaultIndex', "ShopController@defaultIndex")->name("shops.defaultIndex");
    //商家店铺管理
    Route::any('shops/index', "ShopController@index")->name("shops.index");
    Route::any('shops/upload', "ShopController@upload")->name("shops.upload");
    Route::any('shops/reg', "ShopController@reg")->name("shops.reg");
    Route::any('shops/edit/{shops}', "ShopController@edit")->name("shops.edit");
    Route::any('shops/del/{shops}', "ShopController@del")->name("shops.del");
    //商家管理
    Route::any('user/add', "UserController@add")->name("user.add");
    Route::any('user/index', "UserController@index")->name("user.index");
    Route::any('user/edit/{user}', "UserController@edit")->name("user.edit");
    Route::any('user/del/{user}', "UserController@del")->name("user.del");
    Route::any('user/login', "UserController@login")->name("user.login");
    Route::any('user/logout', "UserController@logout")->name("user.logout");
    //商品菜品管理
    Route::any('menuCategories/index', "MenuCategoriesController@index")->name("menuCategories.index");
    Route::any('menuCategories/add', "MenuCategoriesController@add")->name("menuCategories.add");
    Route::any('menuCategories/edit/{menuCategories}', "MenuCategoriesController@edit")->name("menuCategories.edit");
    Route::any('menuCategories/del/{menuCategories}', "MenuCategoriesController@del")->name("menuCategories.del");
    //商家菜品管理
    Route::any('menu/index', "MenuController@index")->name("menu.index");
    Route::any('menu/add', "MenuController@add")->name("menu.add");
    Route::any('menu/edit/{menu}', "MenuController@edit")->name("menu.edit");
    Route::any('menu/del/{menu}', "MenuController@del")->name("menu.del");
    Route::any('menu/upload', "MenuController@upload")->name("menu.upload");
    //活动查看
    Route::any('user/activityIndex', "UserController@activityIndex")->name("user.activityIndex");


    // 订单列表
    Route::any('order/index', "OrderController@index")->name("order.index");
    Route::any('order/change/{order}', "OrderController@change")->name("order.change");
    Route::any('order/list/{order}', "OrderController@list")->name("order.list");
    Route::any('order/send/{order}', "OrderController@send")->name("order.send");
    Route::any('order/orderList', "OrderController@orderList")->name("order.orderList");
    Route::any('order/moth', "OrderController@moth")->name("order.moth");
    Route::any('order/all', "OrderController@all")->name("order.all");
    //菜品销售量
    Route::any('order/cartList', "OrderController@cartList")->name("order.cartList");
    Route::any('order/mothList', "OrderController@mothList")->name("order.mothList");
    Route::any('order/allList', "OrderController@allList")->name("order.allList");


});



