
@extends('layouts.admin.default')
@section("title","订单列表")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">

                                <form class="navbar-form navbar-right" method="get">

                                    <select name="shop_id" class="form-control">
                                        <option value="">请选择商户</option>
                                           @foreach($shops as $shop)
                                            <option value="{{$shop->id}}"@if(request()->input('shop_id')==$shop->id) selected @endif>{{$shop->shop_name}}</option>
                                            @endforeach
                                    </select>
                                    <div class="form-group">
                                        <input type="date" class="form-control" size="3" name="minDate" value="{{request()->input('minDate')}}">------
                                        <input type="date" class="form-control" size="3" name="maxDate" value="{{request()->input('maxDate')}}">
                                    </div>
                                    <button type="submit" class="btn btn-default">搜索</button>
                                </form>

                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding" >
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <th>id</th>
                            <th>订单编号</th>
                            <th>收货地址</th>
                            <th>收货人姓名</th>
                            <th>收货人电话</th>
                            <th>商品价格</th>
                            <th>下单时间</th>
                            <th>状态</th>
                            {{--<th>操作</th>--}}
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->sn}}</td>
                                <td>{{$order->province . $order->city . $order->area . $order->detail_address}}</td>


                                <td>{{$order->name}}</td>
                                <td>{{$order->tel}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    @if($order->status===0)
                                        <a href="#" class="btn btn-success">已取消</a>
                                    @elseif($order->status===1)
                                        <a href="#" class="btn btn-danger">待付款</a>
                                    @elseif($order->status===2)
                                        <a href="#" class="btn btn-danger">待发货</a>
                                    @elseif($order->status===3)
                                        <a href="#" class="btn btn-info">待确认</a>
                                    @elseif($order->status===4)
                                        <a href="#" class="btn btn-info">完成</a>
                                    @endif
                                </td>

                                {{--<td>--}}
                                    {{--<a href="/order/list/{{$order->id}}" class="btn btn-info">查看订单</a>--}}
                                    {{--@if($order->status>0&& $order->status!=3)--}}
                                        {{--<a href="/order/change/{{$order->id}}" class="btn btn-danger">取消订单</a>--}}
                                    {{--@endif--}}
                                    {{--@if($order->status!==3 && $order->status!==0)--}}
                                        {{--<a href="/order/send/{{$order->id}}" class="btn btn-success">发货</a>--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    {{$orders->appends('search')->links()}}
@endsection


