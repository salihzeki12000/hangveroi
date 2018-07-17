<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ isset($_title) ? $_title : '' }}</title>

  <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/main.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('plugins/bootstrap/css/bootstrap.min.css') !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/plugins/font-awesome.min.css') !!}"/>
  <link href="{!! asset('assets/css/style.css') !!}" rel="stylesheet">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->



      <!-- JavaScripts -->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="{!! asset('plugins/bootstrap/js/bootstrap.min.js') !!}"></script>
      <script src="{!! asset('assets/js/jquery.ui.min.js') !!}"></script>


      <!-- plugins -->
      <script src="{!! asset('assets/js/plugins/moment.min.js') !!}"></script>
      <script src="{!! asset('assets/js/plugins/jquery.nicescroll.js') !!}"></script>
      <!-- custom -->

      <script>
        var _base_url = "{{ URL::to('') }}" + "/";
      </script>

      {!! isset($_header) ? $_header : '' !!}

    </head>
    <body id="mimin" class="dashboard">
      <nav class="navbar navbar-default header navbar-fixed-top">
        <div class="col-md-12 nav-wrapper">
          <div class="navbar-header" style="width:100%;">
            <div class="opener-left-menu is-open">
              <span class="top"></span>
              <span class="middle"></span>
              <span class="bottom"></span>
            </div>
            <a href="{{ URL::to('/admin') }}" class="navbar-brand"> 
              <b>OHANGVEROI.COM</b>
            </a>

            <ul class="nav navbar-nav search-nav">
              <li>
                <div class="search">
                  <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                  <div class="form-group form-animate-text">
                    <input type="text" class="form-text" required>
                    <span class="bar"></span>
                    <label class="label-search">Type anywhere to <b>Search</b> </label>
                  </div>
                </div>
              </li>
            </ul>

            <ul class="nav navbar-nav navbar-right user-nav">
              @if (Auth::guest())
              <li class="user-name"><span><a href="{{ url('/login') }}">Login</a></span></li>
              <li class="user-name"><span><a href="{{ url('/register') }}">Register</a></span></li>
              @else
              <li class="user-name"><span>{{ Auth::user()->name }}</span></li>
              <li class="dropdown avatar-dropdown">
                <img src="{!! asset('assets/img/avatar.jpg') !!}" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                <ul class="dropdown-menu user-dropdown">
                  <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                  <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="more">
                    <ul>
                      <li><a href=""><span class="fa fa-cogs"></span></a></li>
                      <li><a href=""><span class="fa fa-lock"></span></a></li>
                      <li><a href="{{ url('/logout') }}"><span class="fa fa-power-off "></span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li ><a href="#" class="opener-right-menu"><span class="fa fa-coffee"></span></a></li>
              @endif
            </ul>
          </div>
        </div>
      </nav>

      @yield('content')

      <script src="{!! asset('assets/js/_main.js') !!}"></script>
      <script src="{!! asset('assets/js/main.js') !!}"></script>
    </body>
    </html>
