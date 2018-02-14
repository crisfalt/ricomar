@extends('layouts.app')

@section('title','Registrar Categoria')

@section('styles')
	<style>

		.quarter {
			height: 400px;
			width: 400px;
		}
		/* estilo para que la imagen quede bien redonda */
		.rounded {
			height: 400px;
			width: 400px;
			-webkit-border-radius: 50%;
			-moz-border-radius: 50%;
			-ms-border-radius: 50%;
			-o-border-radius: 50%;
			border-radius: 50%;
			background-size:cover;
		}
	</style>
@endsection

@section('body-class','profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

</div>

<div class="main main-raised">
	<div class="container">

    	<div class="section">
            <h2 class="title text-center">Registrar Nueva Categoria</h2>

			<div class="team">
				<div class="row">
                    <!-- Mostrar los errores capturados por validate -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ url('/admin/categories') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

	                    <div class="row">
	                        <div class="col-sm-6">
	                            <div class="form-group label-floating">
	                                <label class="control-label">Nombre de la Categoria</label>
	                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
	                            </div>
	                        </div>

							<div class="col-sm-6">
	                             <div class="form-group label-floating">
	                                <label class="control-label">Descripción</label>
	                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
	                            </div>
	                        </div>
	                    </div>
						<div class="row">
							<input type="file" name="photocategory" id="photocategory">
						</div>
						<br>
						<div class="row text-center">
							<!-- Aqui pone la imagen que sube -->
							<img src="" alt="..." class="img quarter" id="image">
						</div>
						<br>
	                    <button class="btn btn-primary">Registrar Categoria</button>
	                    <a href="{{ url('/admin/categories') }}" class="btn btn-default">Cancelar</a>
                	</form>
				</div>
			</div>

        </div>

    </div>

</div>
<script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript"></script>
<script>
    //codigo para mostrar una imagen y refrescar el campo
    function mostrarImagen(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#photocategory').on('change', function (e) {
        mostrarImagen(this);
    });
</script>
<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
