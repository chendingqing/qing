<?php

namespace App\Http\Controllers\api;

use App\Models\Member;
use App\Models\Menu;
use App\Models\Menu_categories;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function list(Request $request)
    {
        $keyword = $request->input('keyword');

        $shops = Shop::where('status', '1')->where('shop_name', 'like', "%$keyword%")->get();

        foreach ($shops as $shop) {
            $shop->distance = rand(1000, 3000);
            $shop->estimate_time = $shop->distance / 100;
        }
        return $shops;
    }

    public function index(Request $request)
    {
        $id = $request->input("id");
        $shop = Shop::findOrFail($id);
        $shop->distance = rand(1000, 3000);
        $shop->estimate_time = $shop->distance / 100;
        //添加评论
        $shop->evaluate = [
            [

                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 1,
                "send_time" => 30,
                "evaluate_details" => "不怎么好吃"
            ],
            [
                "user_id" => 12344,
                "username" => "w******k",
                "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                "time" => "2017-2-22",
                "evaluate_code" => 4.5,
                "send_time" => 30,
                "evaluate_details" => "很好吃"
            ],
        ];

        //取出分类
        $cates = Menu_categories::where("shop_id", $id)->get();
        foreach ($cates as $cate) {
            $cate->goods_list = Menu::where('category_id', $cate->id)->get();
            //把 菜品添加到分类的分类下面

        }
        $shop->commodity = $cates;
        return $shop;
    }

}
