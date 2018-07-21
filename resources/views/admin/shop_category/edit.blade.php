@extends('layouts.default')
@section("title","商家添加")
@section("content")
    <form action="" method="post" class="form-inline col-sm-8 control-label" enctype="multipart/form-data">
        {{ csrf_field() }}
        商家名称： <input type="text" name="name" placeholder="商家名称" value="{{old("name",$shopCategory->name)}}"><br/>
        商家简介： <input type="text" name="shop_intro" placeholder="商家简介" value="{{old("shop_intro",$shopCategory->shop_intro)}}"><br/>
        商家图片：
        <img src="/uploads/{{$shopCategory->shop_img}}"  height="100" width="100">
        <input type="file" name="shop_img"><br/>
        商家状态： <input type="radio" name="status" value="1" {{$shopCategory->status?"checked":""}}/> 是
        <input type="radio" name="status" value="0" {{$shopCategory->status?"":"checked"}}/> 否<br/>
        <input type="submit" value="提交" class="btn btn-success">
    </form>
@endsection