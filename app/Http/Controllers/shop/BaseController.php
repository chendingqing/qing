<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        //添加保安 验证登录
        $this->middleware('auth',[
            'except'=>['login','reg'],
        ]);

    }
}
