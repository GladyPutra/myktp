<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <!------------------------------------------ ICON-------------->
  <link rel="icon" href="{{ asset('template/image/logo.png') }}" type="image" sizes="16x16">
  <link rel="stylesheet" href="{{ asset('template/login_form/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('template/sweetalert/dist/sweetalert.css') }}">
</head>


  <body>
<div class="container">
	<section id="content">
    {{ Form::open(['route'=>'register.store'])  }}
    <form>
			<h1>Form Register</h1>
			<div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
				<input type="text" name="name" placeholder="Nama Lengkap" required="" id="username" value="{{ old('name') }}"/>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>
      <div class="form-group has-feedback {{ $errors->has('nik') ? 'has-error' : '' }}">
				<input type="text" name="nik" placeholder="NIK" required="" id="username"  min="12" max="20" value="{{ old('nik') }}"/>
        {!! $errors->first('nik', '<p class="help-block">:message</p>') !!}
			</div>
			<div>
				<input type="password" name="password" placeholder="Password" required="" min="6" id="password" value="{{ old('password') }}"/>
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
			</div>
			<div>
				<input type="submit" value="Daftar" />
			</div>
		</form>
    {{ Form::close() }}
    <!-- form -->
		<div class="button">
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
    <script src="{{ asset('template/sweetalert/sweetalert.js') }}"></script>
    @include('sweet::alert')
</body>
</html>
