<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My-KTP | Indonesia </title>
    <!------------------------------------------ ICON-------------->
    <link rel="icon" href="{{ asset('template/image/logo.png') }}" type="image" sizes="16x16">

    <!-- Bootstrap -->
    <link href="{{ asset('template/gentella/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('template/gentella/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('template/gentella/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('template/gentella/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{ asset('template/gentella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('template/gentella/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('template/gentella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('template/gentella/build/css/custom.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/sweetalert/dist/sweetalert.css') }}">
    @yield('custom_css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-group"></i> <span>My - KTP Ind</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('template/image/logo.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2>{{ ucwords(Auth::User()->name) }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Beranda</a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('template/image/logo.png') }}" alt="">{{ ucwords(Auth::User()->name) }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
          @yield('content')  <!------------------------------------------------------ CONTENT -------------------------------->
        <!-- /page content -->


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a target="_blank" href="http://kssc07.bismaoperation.id/"> My - KTP Indonesia </a> | 2017
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('template/gentella/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('template/gentella/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('template/gentella/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('template/gentella/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('template/gentella/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('template/gentella/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('template/gentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('template/gentella/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('template/gentella/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('template/gentella/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('template/gentella/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('template/gentella/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('template/gentella/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('template/gentella/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('template/gentella/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('template/gentella/build/js/custom.min.js') }}"></script>
    <script src="{{ asset('template/sweetalert/sweetalert.js') }}"></script>
    @include('sweet::alert')
    @yield('custom_script')

  </body>
</html>
