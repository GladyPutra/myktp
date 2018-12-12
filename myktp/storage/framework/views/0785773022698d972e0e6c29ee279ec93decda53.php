<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login </title>
  <script>window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(),]); ?></script>
  <!------------------------------------------ ICON-------------->
  <link rel="icon" href="<?php echo e(asset('template/image/logo.png')); ?>" type="image" sizes="16x16">
  <link rel="stylesheet" href="<?php echo e(asset('template/login_form/css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/sweetalert/dist/sweetalert.css')); ?>">
</head>
<body>
  <body>
<div class="container">
	<section id="content">
    <form action="<?php echo e(route('login.auth')); ?>" class="login-form" method="post">
      <?php echo csrf_field(); ?>

			<h1>Login Form</h1>
			<div>
				<input type="text" name="username" placeholder="Username / NPM" required="" id="username" />
			</div>
			<div>
				<input type="password" name="password" placeholder="Password" required="" id="password" />
			</div>
			<div>
				<input type="submit" value="Masuk" />
			</div>
      <?php if(Session::has('msg')): ?>
        <?php echo Session::get('msg') ?>
      <?php endif; ?>
    </form>

		<div class="button">
			<a target="_blank" href="<?php echo e(route('login.download')); ?>">Download Pedoman</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>

<script src="<?php echo e(asset('template/sweetalert/sweetalert.js')); ?>"></script>
<?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>
