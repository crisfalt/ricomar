@extends('layouts.app')

@section('title','Editar Categoria')

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
<div class="header header-filter" style="background-image: url('{{ asset('img/fondo2.jpg') }}');">

</div>

<div class="main main-raised">
	<div class="container">

    	<div class="section">
            <h2 class="title text-center">Editar Categoria {{ $category -> name }}</h2>

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
                    <form method="post" action="{{ url('/admin/categories/'.$category->id.'/edit') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre de la Categoria</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}">
                            </div>
                        </div>
						<div class="col-sm-6">
							 <div class="form-group label-floating">
								<label class="control-label">Descripción</label>
								<input type="text" class="form-control" name="description" value="{{ old('description', $category->description) }}">
							</div>
						</div>

                    </div>
					<div class="row">
						<label class="control-label">Imagen de la Categoria</label>
						<input type="file" name="photocategory" id="photocategory">
						<p class="help-block">Subir solo si desea reemplazar la imagen actual!</p>
					</div>
					<br>
					<div class="row text-center">
						@if( $category -> image != "" )
							<img src="/images/categories/{{ $category -> image }}" class="img quarter" id="image" name="image">
						@else
							<img src="/images/categories/default.png" class="img quarter" id="image" name="image">
						@endif
					</div>
					<br>
					<div class="text-center">
						<button class="btn btn-danger">Actualizar Categoria</button>
						<a href="{{ url('/admin/categories') }}" class="btn btn-default">Cancelar</a>
					</div>
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
