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
    <nav class="light-blue lighten-1 navbar navbar-danger navbar-static-top">
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
                        <li><a href="{{ url('/login') }}">登录</a></li>
                        <li><a href="{{ url('/register') }}">注册</a></li>


                </ul>
            </div>
        </div>
    </nav>


<!--Footer-->
<footer class="page-footer blue center-on-small-only">

   

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