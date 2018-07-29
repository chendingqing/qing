<?php

namespace App\Http\Controllers\api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    public function sms(Request $request)
    {
        $this->validate($request, [

        ]);
        $tel = $request->input('tel');
        $code = rand(1000, 9999);
        //把验证码存起来

        Redis::setex("tel_" . $tel, 300, $code);
        return [
            "status" => "true",
            "message" => "获取短信验证码成功" . $code
        ];
        $config = [
            'access_key' => 'LTAIkutC9HFgfFDr',
            'access_secret' => 'WQeqwOPWwcuKhgMwdGF9BdbcyvfokR',
            'sign_name' => '陈定清',
        ];

        $aliSms = new AliSms();
        $response = $aliSms->sendSms('$tel', 'SMS_140665163', ['code' => ''], $config);


        if ($response->Message === "OK") {
            return [
                "status" => "true",
                "message" => "获取短信验证码成功"
            ];
        } else {
            return [
                "status" => "false",
                "message" => $response->Message
            ];
        }
    }

    public function reg(Request $request)
    {

        //接收参数
        $data = $request->all();

        //创建一个验证规则
        $validate = Validator::make($data, [
            'username' => 'required|unique:memebers',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                'unique:memebers'
            ],
            'password' => 'required|min:6'
        ]);
        //验证 如果有错
        if ($validate->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validate->errors()->first()
            ];
        }
        $data['password'] = bcrypt($request->input('password'));
        $sms = $request->input('sms');
        if ($sms === Redis::get("tel_" . $data['tel'])) {
            Member::create($data);
            return [
                "status" => "true",
                "message" => "注册成功"
            ];
        } else {
            return [
                "status" => "true",
                "message" => "注册失败"
            ];
        }

    }

    public function login(Request $request)
    {
        $name = $request->post('name');

        $user = Member::where('username', $name)->first();

        if (($user)) {
                if ($user && Hash::check($request->post('password'), $user->password)) {
                    return [
                        'status' => 'true',
                        'message' => '登录成功',
                        'user_id' => $user->id,
                        'username' => $user->username
                    ];
                }
            }
        return [
            'status' => 'false',
            'message' => '登录失败'
        ];


    }

    public function remember(Request $request)
    {

        $tel = $request->post('tel');
        $user = Member::where('tel', $tel)->first();
        if ($user) {
            $sms = $request->input('sms');
            if ($sms === Redis::get("tel_" . $user->tel)) {
                $date = $request->all();
                $date['password'] = bcrypt($request->post('password'));
                $user->update($date);
                return [
                    "status" => "true",
                    "message" => "重置成功"
                ];
            } else {
                return [
                    "status" => "true",
                    "message" => "重置失败"
                ];
            }

        }
    }

    public function update(Request $request){
        $id=$request->post('id');
        $user=Member::findOrFail($id);
        if ($user && Hash::check($request->post('oldPassword'), $user->password)) {
            $date['password']=bcrypt($request->post("newPassword"));
            if ($user->update($date)) {
                return [
                    'status' => 'true',
                    'message' => '修改成功',
                ];
            }else{
                return [
                    'status' => 'false',
                    'message' => '修改失败',
                ];
            }
            }else{
            return [
                'status' => 'false',
                'message' => '旧密码验证失败',
            ];
        }

    }
}