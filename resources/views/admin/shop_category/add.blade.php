@extends('layouts.admin.default')
@section("title","商家添加")
@section("content")
    <form action="" method="post" class="form-inline col-sm-8 control-label" enctype="multipart/form-data">
        {{ csrf_field() }}
        商家名称： <input type="text" name="name" placeholder="商家名称"><br/>
        商家简介： <input type="text" name="shop_intro" placeholder="商家简介"><br/>
        商家图片：<input type="file" name="shop_img"><br/>
        商家状态：<input type="radio" name="status" value="1" checked/> 是
        <input type="radio" name="status" value="0"/> 否 <br/>

        <input type="submit" value="提交" class="btn btn-success">
    </form>
@endsection