@extends('login.layout')

@section('conteudo-principal')
<form class="login100-form validate-form">
	<span class="login100-form-logo">
		<i class="zmdi zmdi-landscape"></i>
	</span>

	<span class="login100-form-title p-b-34 p-t-27">
		Esqueci minha senha
	</span>

	<div class="wrap-input100 validate-input" data-validate="Enter username">
		<input class="input100" type="email" name="username" placeholder="Username">
		<span class="focus-input100" data-placeholder="&#xf207;"></span>
	</div>


	<div class="container-login100-form-btn">
		<button class="login100-form-btn">
			Reenviar
		</button>
	</div>


</form>
@endsection