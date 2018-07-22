<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index()
    {

        $shop=Auth::user()->shop;
//        dd($user);
        return view('shops.user.index',compact("shop"));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')){
            //健壮性
            $this->validate($request, [
                'name' => 'required|min:2',
                'email' => 'required|email',
                'password' => 'required|min:2',
            ]);
            $data=$request->all();
            User::create($data);
            $request->session()->flash("success","添加成功");
            return redirect()->route("user.index");
        }

        return view("shops.user.add");
    }

    public function edit(Request $request,$id)
    {
        $user=User::find($id);
        if ($request->isMethod('post')) {

            if (Hash::check($request->post('password'),$user->password)) {
                $request->user()->fill([
                    'password' => Hash::make($request->post('re_password'))
                ])->save();
                session()->flash("success","密码修改成功");
                return redirect()->route('user.index');
            }else{
                session()->flash("success","旧密码不正确");
                return redirect()->back()->withInput();
            }
        }
        return view("shops.user.edit",compact('user'));
    }

    public function del(Request $request,$id)
    {
        //通过id找到对象
        $user=User::find($id);
        //删除
        if ($user->delete()) {
            //跳转
            $request->session()->flash("success","删除成功");
            return redirect()->route("user.index");
        }
    }
    public function login(Request $request){

        if($request->isMethod('post')){
            $this->validate($request,[
                "name" => "required|min:2",
                "password" => "required",
            ]);
            if (Auth::attempt(['name' => $request->post('name'), 'password' => $request->post('password')], $request->has('remember'))) {
                   if(Auth::user()->status===0){
                       Auth::logout();
                       session()->flash("success","商家状态已警用");
                       return redirect()->back()->withInput();
                   }
                //提示
                $request->session()->flash("success","登录成功");
                //echo "登录成功";
                //跳转
                return redirect()->route('shops.index');

            }else{
                //提示
                $request->session()->flash("danger","账号或密码错误");
                //跳转
                return redirect()->back()->withInput();
            }
        }
  return view('shops.user.login');
    }
    public function logout(Request $request){
     Auth::logout();
     session()->flash("success","注销成功");
 return redirect()->route("user.login");
    }
}
