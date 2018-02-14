@extends('layouts.app')

@section('title','RicoMar | Dashboard')

@section('styles')
	<style>
		/* estilo para que la imagen quede bien redonda */
		.rounded {
			height: 160px;
			width: 300px;
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
<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
	<div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="{{ $product -> featured_image_url }}" alt="No se encontro" class="img-raised rounded">
                    </div>
                    <div class="name">
                        <h3 class="title">{{ $product -> name }}</h3>
						<h6>{{ $product->category ? $product->category->name : 'General' }}</h6>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p>{{ $product -> long_description }}</p>
            </div>
			<div class="text-center">
				<!-- si hay un usuario ingresado puede agregar el producto al carrito -->
				{{-- @if( auth() -> check() ) si existe una session activa --}}
				@if( auth() -> user() )
					<button class="btn btn-primary btn-round" data-toggle="modal" data-target="#addToCart"><i class="material-icons">add_shopping_cart</i> Añadir Al Carrito</button>
				@else
					{{-- se pone parametro ?redirect_to pasando la url actual para redirigir al usuario a la pagina donde estaba --}}
					<a href="{{ url('/login?redirect_to='.url() -> current() ) }}" class="btn btn-primary btn-round"><i class="material-icons">add_shopping_cart</i> Añadir Al Carrito</a>
				@endif
			</div>
			@if (session('notification'))
				<div class="alert alert-success">
			    	<div class="container-fluid">
						<div class="alert-icon">
							<i class="material-icons">check</i>
						</div>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="material-icons">clear</i></span>
						</button>
						{{ session('notification') }}
					</div>
				</div>
                <!-- <div class="alert alert-success">
                    {{ session('notification') }}
                </div> -->
            @endif

			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="profile-tabs">
	                    <div class="nav-align-center">
		                    <div class="tab-content gallery">
								<div class="tab-pane active" id="studio">
		                            <div class="row">
										<div class="col-md-6">
											@foreach( $imagesLeft as $image )
												<img src="{{ $image -> url }}" class="img-rounded" />
											@endforeach
										</div>
										<div class="col-md-6">
											@foreach( $imagesRight as $image )
												<img src="{{ $image -> url }}" class="img-rounded" />
											@endforeach
										</div>
		                            </div>
		                        </div>
		                    </div>
						</div>
					</div>
					<!-- End Profile Tabs -->
				</div>
            </div>
			<div class="text-center">
				@if( auth() -> user() )
					@if( auth() -> user() -> admin)
						<a href="{{ url('/admin/products') }}" class="btn btn-primary btn-round"><i class="material-icons">keyboard_arrow_left</i> Volver a Productos</a>
					@else
						<a href="{{ url('/') }}" class="btn btn-primary btn-round"><i class="material-icons">keyboard_arrow_left</i> Volver a Categorias</a>
					@endif
				@else
					<a href="{{ url('/') }}" class="btn btn-primary btn-round"><i class="material-icons">keyboard_arrow_left</i> Volver a Categorias</a>
				@endif
			</div>
        </div>
    </div>
</div>

<!-- modal para que pueda escoger la cantidad -->
<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Seleccione la cantidad que desea Comprar</h4>
	  </div>
	  <form class="" action="{{ url('/cart') }}" method="post">
		  {{ csrf_field() }}
		  <input type="hidden" name="product_id" value="{{ $product -> id }}">
		  <div class="modal-body">
    		  <div class="input-group text-center">
    			<span class="input-group-addon">
    				<i class="material-icons">add</i>
    			</span>
    			<input class="form-control" type="number" name="quantity" value="1" min="1">
    		 </div>
    	  </div>
    	  <div class="modal-footer">
    		<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
    		<button type="submit" class="btn btn-info btn-simple">Añadir Al Carrito</button>
    	  </div>
	  </form>
	</div>
  </div>
</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
