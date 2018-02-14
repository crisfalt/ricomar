@extends('layouts.app')

@section('title','Resultado de la Busqueda')

@section('styles')
	<style>

		.team {
			padding-bottom: 50px;
		}

		.team .row .col-md-4 {
			margin-bottom: 5em;
		}

		/* codigo para que todas las columnas en bootstrap tengan la misma altura */
		.team .row {
		  display: -webkit-box;
		  display: -webkit-flex;
		  display: -ms-flexbox;
		  display:         flex;
		  flex-wrap: wrap;
		}
		.team .row > [class*='col-'] {
		  display: flex;
		  flex-direction: column;
		}

		.tt-query {
		  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			 -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
				  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
		}

		.tt-hint {
		  color: #999
		}

		.tt-menu {    /* used to be tt-dropdown-menu in older versions */
		  width: 222px;
		  margin-top: 4px;
		  padding: 4px 0;
		  background-color: #fff;
		  border: 1px solid #ccc;
		  border: 1px solid rgba(0, 0, 0, 0.2);
		  -webkit-border-radius: 4px;
			 -moz-border-radius: 4px;
				  border-radius: 4px;
		  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
			 -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
				  box-shadow: 0 5px 10px rgba(0,0,0,.2);
		}

		.tt-suggestion {
		  padding: 3px 20px;
		  line-height: 24px;
		}

		.tt-suggestion.tt-cursor,.tt-suggestion:hover {
		  color: #fff;
		  background-color: #0097cf;

		}

		.tt-suggestion p {
		  margin: 0;
		}
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
                        <img src="/img/search.png" alt="No se encontro la lupa" class="img-raised rounded">
                    </div>
                    <div class="name">
                        <h3 class="title">Resultados de la Busqueda</h3>
                    </div>
                </div>
            </div>
            <div class="description text-center">
				<!-- con count no se obtiene toda la cantidad total de paginate con total si  -->
                <p>Se encontraron {{ $products -> total() }} Resultados para la palabra {{ $query }}</p>
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

			<div class="team text-center">
    				<div class="row">
                        @foreach ($products as $product)
    					<div class="col-md-4 col-xs-12 text-center">
    	                    <div class="team-player">
                                <!-- featured_image_url , path creada en el modelo product::getFeaturedImageUrlAttribute -->
    	                        <img src="{{ $product -> featured_image_url }}" alt="Thumbnail Image" class="img-raised rounded">
    	                        <h4 class="title">
                                    <a href="{{ url('/products/'.$product -> id) }}">{{ $product -> name }} </a><br />
    							</h4>
    	                        <p class="description">{{ $product->description }}</p>
    	                    </div>
    	                </div>
                        @endforeach
    				</div>
                <!-- para mostrar la paginacion hecha en el controlador -->
                {{ $products -> links() }}
			</div>

			<div class="text-center">
				<a href="{{ url('/') }}" class="btn btn-primary"><i class="material-icons">chevron_left</i> Volver</a>
			</div>
        </div>
    </div>
</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
