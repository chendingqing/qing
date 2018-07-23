@extends('layouts.default')
@section("title","店铺注册列表")
@section('content')

    <form action="" method="post" class="form-inline col-sm-8 control-label" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            菜品名称：<input type="text" class="form-control" placeholder="name" name="goods_name" >
        </div>
        <br/>
        <div class="form-group">
            菜品 评分： <input type="text" class="form-control"  name="rating">
        </div>
        <br/>
        所属分类:<select name="category_id" >
            @foreach($cates as $cate)
                <option value="{{$cate->id}}">{{$cate->name}}</option>
            @endforeach
        </select>
        <br/>
        <div class="form-group">
            商品价格 : <input type="text" class="form-control" name="goods_price">
        </div>
        <br/>
        <div class="form-group">
            菜品 描述 ： <input type="text" class="form-control" name="description">
        </div>
        <br/>
        <div class="form-group">
            菜品 销量：  <input type="text" class="form-control" name="month_sales">
        </div>
        <br/>
        <div class="form-group">
            评分数量 ： <input type="text" class="form-control" name="rating_count">
        </div>
        <br/>
        <div class="form-group">
            提示信息:<input type="text" class="form-control" name="tips">
        </div>
        <br/>
        <div class="form-group">
            满意数量:<input type="text" class="form-control" name="satisfy_count">
        </div>
        <br/>
        <div class="form-group">
            满意评分:<input type="text" class="form-control" name="satisfy_rate">
        </div>
        <br/>
        <div class="form-group">
            菜品图片:<input type="file" name="goods_img">
        </div>
        <br/>
        <div class="checkbox">
            菜品状态:<label>
                <input type="checkbox" value="1" name="status">是
            </label>
            <label>
                <input type="checkbox" value="0"name="status">否
            </label>
        </div>
  <br/>
        <button type="submit" class="btn btn-success">添加菜品</button>
    </form>
@endsection