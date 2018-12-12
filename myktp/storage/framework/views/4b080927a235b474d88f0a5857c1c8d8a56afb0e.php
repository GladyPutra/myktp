<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <!------------------------------------------ ICON-------------->
  <link rel="icon" href="<?php echo e(asset('template/image/logo.png')); ?>" type="image" sizes="16x16">
  <link rel="stylesheet" href="<?php echo e(asset('template/login_form/css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('template/sweetalert/dist/sweetalert.css')); ?>">
</head>


  <body>
<div class="container">
	<section id="content">
    <?php echo e(Form::open(['route'=>'register.store'])); ?>

    <form>
			<h1>Form Register</h1>
			<div class="form-group has-feedback <?php echo e($errors->has('first_name') ? 'has-error' : ''); ?>">
				<input type="text" name="first_name" placeholder="Nama Depan" required="" id="username" />
        <?php echo $errors->first('first_name', '<p class="help-block">:message</p>'); ?>

			</div>
      <div class="form-group has-feedback <?php echo e($errors->has('last_name') ? 'has-error' : ''); ?>">
				<input type="text" name="last_name" placeholder="Nama Belakang" required="" id="username" />
        <?php echo $errors->first('last_name', '<p class="help-block">:message</p>'); ?>

			</div>
      <div class="form-group has-feedback <?php echo e($errors->has('npm') ? 'has-error' : ''); ?>">
				<input type="text" name="npm" placeholder="NPM" required="" id="username" pattern="[0-9]{9}"/>
        <?php echo $errors->first('npm', '<p class="help-block">:message</p>'); ?>

			</div>
			<div>
				<input type="password" name="password" placeholder="Password" required="" id="password" />
        <?php echo $errors->first('password', '<p class="help-block">:message</p>'); ?>

			</div>
			<div>
				<input type="submit" value="Daftar" />
			</div>
		</form>
    <?php echo e(Form::close()); ?>

    <!-- form -->
		<div class="button">
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
    <script src="<?php echo e(asset('template/sweetalert/sweetalert.js')); ?>"></script>
    <?php echo $__env->make('sweet::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
