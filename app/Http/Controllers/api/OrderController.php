<?php

namespace App\Http\Controllers\api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\orderGood;
use App\Models\Shop;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function add(Request $request)
    {
        $user_id = $request->get('user_id');
        $address_id = $request->get('address_id');
        if ($address_id === null) {
            return [
                "status" => "false",
                "message" => "请选择地址"
            ];
        }
        $data = [];
        $goods = Cart::where("user_id", $user_id)->get();
        $total = '';
        foreach ($goods as $k => $v) {
            $good = Menu::where("id", $v->goods_id)->first();
            $shop_id = $good->shop_id;
            $total += $v->amount * $good->goods_price;
        }
        $address = Address::where("id", $address_id)->first(['provence', 'city', 'area', 'detail_address', 'tel', 'name']);
        $data['shop_id'] = $shop_id;
        $data['user_id'] = $user_id;
        $data['sn'] = date('ymdHis') . rand(1000, 9999);
        $data['province'] = $address->provence;
        $data['city'] = $address->city;
        $data['area'] = $address->area;
        $data['detail_address'] = $address->detail_address;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
        $data['status'] = 1;
        $data['total'] = $total;
        //开启事务
        DB::beginTransaction();

        try {


            $order = Order::create($data);

            foreach ($goods as $a => $b) {
                $good = Menu::find($b->goods_id);
                $date['order_id'] = $order->id;
                $date['goods_id'] = $good->id;
                $date['amount'] = $b->amount;
                $date['goods_name'] = $good->goods_name;
                $date['goods_img'] = $good->goods_img;
                $date['goods_price'] = $good->goods_price;
                orderGood::create($date);

            }
            DB::commit();
        } catch (QueryException $exception) {
            //回滚
            DB::rollBack();
            //返回数据
            return [
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }


        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];

    }

    public function find(Request $request)
    {
        $id = $request->get('id');
        $data = [];
        $orders = Order::where("id", $id)->first();

        $data['id'] = $id;
        $data['order_code'] = $orders->sn;
        $data['order_birth_time'] = "{$orders->created_at}";
        $data['order_status'] = $orders->order_status;
        $data['shop_id'] = $orders->shop_id;
        $shops = Shop::where("id", $data['shop_id'])->first();
        $data['shop_name'] = $shops->shop_name;
        $data['shop_img'] = $shops->shop_img;
        $data['order_price'] = $orders->total;
        $data['order_address'] = $orders->province . $orders->city . $orders->area . $orders->detail_address;
        $data['goods_list'] = $orders->goods;
        return $data;

    }

    public function pay(Request $request)
    {
        $id = $request->post("id");

        $moneys = Order::where("id", $id)->first();
        $amount = $moneys->total;
        $user_id = $moneys->user_id;
        $users = Member::where("id", $user_id)->first();
        $user_money = $users->money;
        if ($user_money > $amount) {
            $user_money = $user_money - $amount;
            $data['money'] = $user_money;
            $users->update($data);
            $date['status'] = 2;
            $moneys->update($date);
            return [
                'status' => "true",
                "message" => "支付成功"
            ];

        } else {
            return [
                'status' => "false",
                "message" => "余额不足"
            ];
        }

    }

    public function list(Request $request)
    {
        $id = $request->post("user_id");
        $data = [];
        $orders = Order::where("user_id", $id)->get();
        foreach ($orders as $order) {
            $data['id'] = $id;
            $data['order_code'] = $order->sn;
            $data['order_birth_time'] = "{$order->created_at}";
            $data['order_status'] = $order->order_status;
            $data['shop_id'] = $order->shop_id;
            $shops = Shop::where("id", $data['shop_id'])->first();
            $data['shop_name'] = $shops->shop_name;
            $data['shop_img'] = $shops->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->province . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->goods;
            $dates[] = $data;

        }
        return $dates;
    }

}
