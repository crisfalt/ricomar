@extends('layouts.app')

@section('title','Imagenes de Producto')

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
				<input type="file" name="photo">
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
<!-- <script type="text/javascript">
	function cargarTxt( file ) {
		$valor = document.getElementById('txtPhoto').value = file.value;
		//alert($valor);
	}
</script> -->

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
