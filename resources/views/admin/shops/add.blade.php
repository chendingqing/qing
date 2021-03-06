@extends('layouts.admin.default')
@section("title","店铺注册列表")
@section('content')

    <form action="" method="post" class="form-inline col-sm-8 control-label" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" placeholder="name" name="name" >
        </div>
        <br/>
        <div class="form-group">
            <input type="password" class="form-control"  placeholder="Password" name="password">
        </div>
        <br/>
        <div class="form-group">
            <input type="email" class="form-control"  placeholder="email" name="email">
        </div>
        <br/>
        <div class="form-group">
            <input type="text" class="form-control"  placeholder="店铺名称" name="shops_name">
        </div>
        <br/>
        <div class="form-group">
            店铺分类:<select name="shop_category_id" >
                @foreach($cates as $cate)
                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                @endforeach
            </select>
        </div>
        <br/>
        <div class="form-group">
            店铺图片:<input type="file" name="img">
        </div>
        <br/>
        <div class="checkbox">
            是否品牌:<label>
                <input type="checkbox" value="1" name="brand">是
            </label>
            <label>
                <input type="checkbox" value="0" name="brand">否
            </label>
        </div>
        <br/>
        <div class="checkbox">
            是否准时送达:<label>
                <input type="checkbox" value="1" name="on_time">是
            </label>
            <label>
                <input type="checkbox" value="0" name="on_time">否
            </label>
        </div>
        <br/>
        <div class="checkbox">
            是否蜂鸟配送:<label>
                <input type="checkbox" value="1" name="fengniao">是
            </label>
            <label>
                <input type="checkbox" value="0" name="fengniao">否
            </label>
        </div>
        <br/>
        <div class="checkbox">
            是否保:<label>
                <input type="checkbox" value="1" name="bao">是
            </label>
            <label>
                <input type="checkbox" value="0" name="bao">否
            </label>
        </div>
        <br/>
        <div class="checkbox">
            是否票:<label>
                <input type="checkbox" value="1" name="piao">是
            </label>
            <label>
                <input type="checkbox" value="0" name="piao">否
            </label>
        </div>
        <br/>
        <div class="checkbox">
            是否准:<label>
                <input type="checkbox" value="1" name="zhun">是
            </label>
            <label>
                <input type="checkbox" value="0" name="zhun">否
            </label>
        </div>
        <br/>
        <div class="form-group">
            <input type="text" class="form-control"  placeholder="起送金额" name="start_send">
        </div>
        <br/>
        <div class="form-group">
            <input type="text" class="form-control"  placeholder="配送费" name="send_cost">
        </div>
        <br/>
        <button type="submit" class="btn btn-default">注册</button>
    </form>
@endsection