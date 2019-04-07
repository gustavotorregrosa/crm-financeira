@extends('login.layout')

@section('conteudo-principal')
<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
	@csrf
	<span class="login100-form-logo">
		<i class="zmdi zmdi-landscape"></i>
	</span>

	<span class="login100-form-title p-b-34 p-t-27">
		Log in
	</span>

	<div class="wrap-input100 validate-input" data-validate="Enter username">
		<input class="input100" type="email" placeholder="email" name="email" value="{{ old('email') }}" required autofocus>
		<span class="focus-input100" data-placeholder="&#xf207;"></span>
	</div>

	<div class="wrap-input100 validate-input" data-validate="Enter password">
		<input class="input100" type="password" placeholder="Password" name="password" required>
		<span class="focus-input100" data-placeholder="&#xf191;"></span>
	</div>

	<div class="contact100-form-checkbox">
		<input class="input-checkbox100" type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		<label class="label-checkbox100" for="remember">
			Remember me
		</label>
	</div>

	<div class="container-login100-form-btn">
		<button type="submit" class="login100-form-btn">
			Login
		</button>
	</div>

	<div class="text-center p-t-90">
		<a class="txt1" href="#">
			Forgot Password?
		</a>
	</div>
</form>
@endsection