
@extends('layouts.admin.default')
@section("title","订单量统计")
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <form class="navbar-form navbar-right"action="" method="get">
                                <select name="shop_id" class="form-control">
                                    <option value="">请选择商户</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->shop_id}}"@if(request()->input('shop_id')==$user->shop_id) selected @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <input type="date" name="start" class="form-control" size="2" placeholder="" value="{{request()->input('start')}}">——
                                <input type="date" name="end" class="form-control" size="2" placeholder=""  value="{{request()->input('end')}}">
                                <button type="submit" class="btn btn-default">搜索</button>
                            </form>
                        </div><!-- /.navbar-collapse -->

                </nav>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding" >
                    <table class="table table-hover table-bordered">
                        <tbody>
                      @if($shopId=="")
                        <h2 align="center" >所有商铺每日总订单量</h2>
                       @elseif($shopId==$shop_id)
                          <h2 align="center" >搜索商家每日订单量</h2>
                      @endif
                        <tr>
                            <th>时间</th>
                            <th>盈利金额</th>
                            <th>订单数量</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->date}}</td>
                                <td>{{$order->money}}</td>
                                <td>{{$order->count}}</td>
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
    {{--{{$orders->links()}}--}}
@endsection


