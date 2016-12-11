<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>湖南农业大学在线考试系统</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-material-design.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ripples.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>

</head><body id="app-layout">
    <!-- -->
    <nav class="light-blue lighten-1 navbar  navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <!--BootStrap Hamburger-->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--Logo Can be clicked and Directed to the index.blade.php-->
                <a class="" href="{{ url('/') }}">

                    <img src="/img/hauoes.png" width="310" height="115">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                        <li><a href="{{ url('/login') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a></li>

                        @if(Auth::guest())
                            <li><a href="{{ url('/login') }}">登录</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('user/'.Auth::user()->id.'/resetPwd') }}"><i class="fa fa-lock"></i> 修改密码</a></li>
                                @can('manage')
                                <li><a href="{{ url('admin/questions') }}"><i class="fa fa-btn fa-pencil"></i>题库管理</a></li>
                                <li><a href="{{ url('admin/papers') }}"><i class="fa fa-btn fa-newspaper-o"></i>试卷管理</a></li>
                                <li><a href="{{ url('admin/scoreMgr') }}"><i class="fa fa-btn fa-percent"></i>成绩管理</a></li>
                                @can('manageUser')
                                <li><a href="{{ url('admin/usersMgr') }}"><i class="fa fa-btn fa-users"></i>用户管理</a></li>
                                @endcan
                                <li><a href="{{ url('/admin/resources') }}"><i class="fa fa-btn fa-book"></i>资料库管理</a></li>

                                @can('manageUser')
                                <li><a href="{{ url('admin/logs') }}"><i class="fa fa-btn fa-calendar"></i>查看日志</a></li>
                                @endcan
                                @endcan
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>退出登录</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

@yield('content')
<!--Footer-->
<footer class="navbar-fixed-bottom page-footer blue center-on-small-only" >

   

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            <i class="fa fa-address-book" aria-hidden="true" ></i>
© 2017 版权: <a href="{{ url('/') }}"> 湖南农业大学理学院信科系 </a>

        </div>

    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

      
    </body>
</html>