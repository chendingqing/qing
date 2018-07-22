<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        //添加保安 验证登录
        $this->middleware('auth:admin',[
            'except'=>['login','index'],
        ]);
        $this->middleware('guest:admin',[
            'only'=>['login'],
        ]);
    }
}
