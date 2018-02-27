@extends('layouts.app')

@section('title','RicoMar | Categorias')

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

		.cout-size {
            height: 160px;
			width: 300px;
        }

		.font-description {
            font-size : 1.2em;
        }

		*{
            margin:0;
        }

        #fixed {
            
            left: calc( 100% - 54px );
            top: cacl(100% - 10px );;
            color : red;
            font-size: 30px;
            position: fixed;

        }

	</style>
@endsection

@section('body-class','profile-page')

@section('cartFixed')
<a href="{{ url('/home') }}" class=""><i id="fixed" class="material-icons">shopping_cart</i></a>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/fondo2.jpg') }}');"></div>

<div class="main main-raised">
	<div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="/images/categories/{{ $category -> image }}" alt="No se encontro" class="img cout-size">
                    </div>
                    <div class="name">
                        <h3 class="title">{{ $category -> name }}</h3>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p class="font-description">{{ $category -> description }}</p>
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
    	                        <a href="{{ url('/products/'.$product -> id) }}"><img src="{{ $product -> featured_image_url }}" alt="Thumbnail Image" class="img cout-size"></a>
    	                        <h4 class="title">
                                    <a href="{{ url('/products/'.$product -> id) }}">{{ $product -> name }} </a><br />
    							</h4>
    	                        <p class="description font-description">{{ $product->long_description }}</p>
								<h4 class="title">
                                    $ {{ $product -> price }}
    							</h4>
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
