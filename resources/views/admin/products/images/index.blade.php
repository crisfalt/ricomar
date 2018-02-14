@extends('layouts.app')

@section('title','Imagenes de Producto')

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
    	<div class="section text-center">
            <h2 class="title">Imágenes de Producto "{{ $product -> name }}"</h2>
			@if ($errors->any())
			<div class="alert alert-danger text-left">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<!-- <div class="panel panel-default">
				<div class="panel-body"> -->
			<form method="POST" action="" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="row">
					<input type="file" name="photo" id="photo">
				</div>
				<br>
				<div class="row text-center">
					<!-- Aqui pone la imagen que sube -->
					<img src="" alt="..." class="img quarter" id="image">
				</div>
				<!-- <input type="hidden" id="txtPhoto" name="txtPhoto" value=""> -->
				<button type="submit" class="btn btn-primary btn-round">Subir Nueva Imagen</button>
				<a href="{{ url('/admin/products') }}" class="btn btn-default btn-round">Volver al listado de productos</a>
			</form>
				<!-- </div>
			</div> -->
			<hr>
			<div class="row">
				@foreach( $images as $image )
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-body">
							<!-- campo calculado en el modelo productimage metodo getUrlAttribute -->
							<img class="img-raised img-rounded" src="{{ $image -> url }}" alt="" width="250" height="250">
							<form method="post" action="">
								{{ csrf_field() }}
	                            {{ method_field('DELETE') }}
	                            <input type="hidden" name="image_id" value="{{ $image -> id }}">
								<button type="submit" class="btn btn-danger btn-round">Eliminar Imagen</button>
								@if( $image -> featured == true )
									<button type="button" class="btn btn-info btn-fab btn-fab-mini btn-round" rel="tooltip" title="Imagen destacada actualmente"><i class="material-icons">favorite</i></button>
								@else
									<a href="{{ url('/admin/products/'.$product -> id.'/images/select/'.$image -> id) }}" class="btn btn-primary btn-fab btn-fab-mini btn-round" rel="tooltip" title="Imagen por destacar"><i class="material-icons">favorite</i></a>
								@endif
							</form>
						</div>
					</div>
				</div>
				@endforeach
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

    $('#photo').on('change', function (e) {
        mostrarImagen(this);
    });
</script>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
