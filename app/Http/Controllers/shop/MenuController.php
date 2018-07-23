<?php

namespace App\Http\Controllers\shop;

use App\Models\Menu;
use App\Models\Menu_categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
  public function index(Request $request){
      $minMoney=$request->input("minMoney");
      $maxMoney=$request->input("maxMoney");
      $keywords=$request->input("keywords");
      $menuId=$request->input("menu_id");
      $id=Auth::user()->id;
      $query=Menu::orderBy("id")->where("shop_id",$id);

     if ($minMoney!==null){
         $query->where("goods_price",'>=',$minMoney);
     }
      if ($maxMoney!==null){
          $query->where("goods_price",'<=',$maxMoney);
      }
      if ($keywords!==null){
          $query->where("goods_name",'like',"%{$keywords}%");
      }
      if ($menuId!==null){
          $query->where("category_id",'=',"$menuId");
      }

      $menus=$query->get();

      $menuCategorys=Menu_categories::all();
return view("shops.menu.index",compact("menus","menuCategorys"));
  }



  public function add(Request $request){
   $cates=Menu_categories::all();
   if($request->isMethod("post")){

       $data=$request->all();
       $data['goods_img']=  $request->file("goods_img")->store("goods", "images");
       $data['shop_id']=Auth::user()->id;
      $data['category_id']=$request->post('category_id');

       if (Menu::create($data)) {
           session()->flash("success","添加成功");
           return redirect()->route('menu.index');
       }

   }




return view("shops.menu.add",compact("cates"));
  }
  public function edit(Request $request,$id){
      $cates=Menu_categories::all();
      $menu=Menu::findOrFail($id);
      if($request->isMethod("post")){

          $data=$request->all();
          $data['goods_img']=  $request->file("goods_img")->store("goods", "images");
          $data['shop_id']=Auth::user()->id;
          $data['category_id']=$request->post('category_id');

          if ($menu->save($data)) {
              session()->flash("success","编辑成功");
              return redirect()->route('menu.index');
          }
      }
      return view("shops.menu.edit",compact("cates",'menu'));
  }
public function del(Request $request,$id){
   $menu=Menu::findOrFail($id);
    if (File::delete(public_path("/uploads/$menu->goods_img"))) {
        $menu->delete();
        session()->flash("success","删除成功");
        return redirect()->route('menu.index');
    }


}

}
