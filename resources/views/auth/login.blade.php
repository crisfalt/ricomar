@extends('layouts.app')

@section('body-class','signup-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/fondo2.jpg') }}'); background-size: cover; background-position: top center;">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<div class="card card-signup">
					<form class="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
							<h4>Inicio de Sesión</h4>
							<!-- <div class="social-line">
								<a href="#pablo" class="btn btn-simple btn-just-icon">
									<i class="fa fa-facebook-square"></i>
								</a>
								<a href="#pablo" class="btn btn-simple btn-just-icon">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#pablo" class="btn btn-simple btn-just-icon">
									<i class="fa fa-google-plus"></i>
								</a>
							</div> -->
						</div>
						{{-- mostrar cuando hayan errores --}}
						@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						{{-- mostrar cuando llegue una notificacion --}}
						@if ($notification != "" )
							<div class="alert alert-danger">
						    	<div class="container-fluid">
									<div class="alert-icon">
										<i class="material-icons">check</i>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true"><i class="material-icons">clear</i></span>
									</button>
									{{ $notification }}
								</div>
							</div>
			            @endif
						<p class="text-divider">Ingresa Tus Datos</p>
						<div class="content">

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">fingerprint</i>
								</span>
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Nombre de Usuario..." required autofocus>
							</div>

							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">lock_outline</i>
								</span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña..." required>
							</div>

							<!-- If you want to add a checkbox to this form, uncomment this code-->

							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
									Recordar Sesion
								</label>
							</div>
						</div>
						<div class="footer text-center">
							<button type="submit" class="btn btn-simple btn-primary btn-lg">Ingresar</button>
						</div>
                        <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a> -->
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- incluir el footer desde una vista en la carpeta includes -->
	@include('includes.footer')

</div>
@endsection
