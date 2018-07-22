<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">清</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @auth('admin')
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://shop.elm.com/user/index">用户管理 <span class="sr-only">(current)</span></a></li>
                <li><a href="http://admin.elm.com/shop/index">商铺管理</a></li>
                <li><a href="http://admin.elm.com/admin/index">管理员管理</a></li>
                <li><a href="{{route('user.index')}}">商户管理</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">无聊就看看吧！ <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">减肥秘诀</a></li>
                        <li><a href="#">少吃肉，多吃蔬菜</a></li>
                        <li><a href="#">多敲代码，少抽烟</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">努力吧！肥仔@</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">期待更好的你，而不是自甘堕弱的你!加油！</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right" >

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">查看个人信息</a></li>
                            <li><a href="">修改密码</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('admin.logout')}}">注销</a></li>
                        </ul>
                    </li>
            </ul>
            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    @endauth
    @guest('admin')
        <ul class="nav navbar-nav navbar-right" >
            <li><a href="{{route("admin.login")}}">登录</a></li>
        </ul>
    @endguest
</nav>
