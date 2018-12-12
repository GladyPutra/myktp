<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KKM - UAJY </title>
    <!------------------------------------------ ICON-------------->
    <link rel="icon" href="<?php echo e(asset('template/image/logo.png')); ?>" type="image" sizes="16x16">

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('template/gentella/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('template/gentella/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('template/gentella/vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo e(asset('template/gentella/vendors/iCheck/skins/flat/green.css')); ?>" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo e(asset('template/gentella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')); ?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo e(asset('template/gentella/vendors/jqvmap/dist/jqvmap.min.css')); ?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo e(asset('template/gentella/vendors/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('template/gentella/build/css/custom.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/sweetalert/dist/sweetalert.css')); ?>">
    <?php echo $__env->yieldContent('custom_css'); ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-group"></i> <span>KKM - UAJY</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo e(asset('template/image/logo.png')); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2><?php echo e(Auth::User()->first_name); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo e(route('dashboard')); ?>"><i class="fa fa-home"></i> Beranda</a></li>
                  <?php if(Auth::User()->role_id == "PKM" || Auth::User()->role_id == "Pnl" || Auth::User()->role_id == "Adm" || Auth::User()->role_id == "SK"): ?>
                  <li><a><i class="fa fa-list"></i> Daftar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(Auth::User()->role_id == "PKM" || Auth::User()->role_id == "Pnl" || Auth::User()->role_id == "Adm"): ?>
                        <li><a href="<?php echo e(route('peserta.index')); ?>">Peserta PKM</a></li>
                      <?php endif; ?>
                      <?php if(Auth::User()->role_id == "SK" || Auth::User()->role_id == "Adm"): ?>
                        <li><a href="<?php echo e(route('pengurus.index')); ?>">Pengurus KKM</a></li>
                      <?php endif; ?>
                    </ul>
                  </li>
                  <?php endif; ?>
                  <?php if(Auth::User()->role_id == "PKM" || Auth::User()->role_id == "Pnl" || Auth::User()->role_id == "Adm" || Auth::User()->role_id == "SK"): ?>
                  <li><a><i class="fa fa-file"></i> Berkas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(Auth::User()->role_id == "PKM" || Auth::User()->role_id == "Pnl" || Auth::User()->role_id == "Adm"): ?>
                        <li><a href="">Proposal PKM</a></li>
                        <li><a href="<?php echo e(route('berkas.index')); ?>">Berkas Kelengkapan PKM</a></li>
                      <?php endif; ?>
                      <?php if(Auth::User()->role_id == "SK" || Auth::User()->role_id == "Adm"): ?>
                        <li><a href="">Surat Menyurat</a></li>
                      <?php endif; ?>
                    </ul>
                  </li>
                  <?php endif; ?>
                  <?php if(Auth::User()->role_id == "Adm"): ?>
                  <li><a href="<?php echo e(route('pengguna.index')); ?>"><i class="fa fa-group"></i> Daftar Pengguna</a></li>
                  <?php endif; ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a href="<?php echo e(route('pengaturan.profil')); ?>" data-toggle="tooltip" data-placement="top" title="Profil">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </a>
              <a target="_blank" href="<?php echo e(route('login.download')); ?>" data-toggle="tooltip" data-placement="top" title="Pedoman">
                <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Pengaturan" href="<?php echo e(route('pengaturan.index')); ?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Keluar" href="<?php echo e(route('logout')); ?>">
                <span class="fa fa-sign-out" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
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
                    <img src="<?php echo e(asset('template/image/logo.png')); ?>" alt=""><?php echo e(Auth::User()->first_name); ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo e(route('pengaturan.profil')); ?>"> Profil</a></li>
                    <li>
                      <a href="<?php echo e(route('pengaturan.index')); ?>">
                        <span class="badge bg-red pull-right"></span>
                        <span>Pengaturan</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Bantuan</a></li>
                    <li><a href="<?php echo e(route('logout')); ?>"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
          <?php echo $__env->yieldContent('content'); ?>  <!------------------------------------------------------ CONTENT -------------------------------->
        <!-- /page content -->


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a href="https://kkm.uajy.ac.id"> Komunitas Kreativitas Mahasiswa </a> | UAJY | Creativity Has No Limit
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo e(asset('template/gentella/vendors/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('template/gentella/vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('template/gentella/vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo e(asset('template/gentella/vendors/nprogress/nprogress.js')); ?>"></script>
    <!-- Chart.js -->
    <script src="<?php echo e(asset('template/gentella/vendors/Chart.js/dist/Chart.min.js')); ?>"></script>
    <!-- gauge.js -->
    <script src="<?php echo e(asset('template/gentella/vendors/gauge.js/dist/gauge.min.js')); ?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo e(asset('template/gentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo e(asset('template/gentella/vendors/iCheck/icheck.min.js')); ?>"></script>
    <!-- Skycons -->
    <script src="<?php echo e(asset('template/gentella/vendors/skycons/skycons.js')); ?>"></script>
    <!-- Flot -->
    <script src="<?php echo e(asset('template/gentella/vendors/Flot/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/Flot/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/Flot/jquery.flot.time.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/Flot/jquery.flot.stack.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/Flot/jquery.flot.resize.js')); ?>"></script>
    <!-- Flot plugins -->
    <script src="<?php echo e(asset('template/gentella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/flot-spline/js/jquery.flot.spline.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/flot.curvedlines/curvedLines.js')); ?>"></script>
    <!-- DateJS -->
    <script src="<?php echo e(asset('template/gentella/vendors/DateJS/build/date.js')); ?>"></script>
    <!-- JQVMap -->
    <script src="<?php echo e(asset('template/gentella/vendors/jqvmap/dist/jquery.vmap.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/jqvmap/dist/maps/jquery.vmap.world.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')); ?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo e(asset('template/gentella/vendors/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/gentella/vendors/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo e(asset('template/gentella/build/js/custom.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/sweetalert/sweetalert.js')); ?>"></script>
    <?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('custom_script'); ?>

  </body>
</html>
