@extends('layouts.app')

@section('title','Bienvenido a ' . config( 'app.name' ) )

@section('body-class','landing-page')

<!-- crear estislo solo para una pagina -->
@section('styles')
    <style media="screen">
        .team .row .col-md-4 {
            margin-bottom: 5em;
            width: ;
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

        .cout-size {
            height: 200px;
			width: 300px;
        }

        .rounded {
			height: 180px;
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

@section('content')
<div class="header header-filter" style="background-image: url('/img/fondo2.jpg');">
    <div class="container">
        <div class="row">
			<div class="col-md-6">
				<h1 class="title">Bienvenido a {{ config( 'app.name' ) }}</h1>
                <h3>Realiza tus pedidos en linea y te contactaremos para coordinar la entrega </h3>
                <br />
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger btn-raised btn-lg">
					<i class="fa fa-play"></i> Como Funciona?
				</a>
			</div>
        </div>
    </div>
</div>

<div class="main main-raised">
	<div class="container">
    	<div class="section text-center">
            <h2 class="title">Visita Nuestras Categorías</h2>
            <form class="form-inline" action="{{ url('/search') }}" method="get">
                <input type="text" id="search" name="search" value="" placeholder="¿Que producto buscas?" class="form-control">
                <button class="btn btn-primary btn-just-icon" type="submit">
                	<i class="material-icons">search</i>
                </button>
            </form>
			<div class="team">
				<div class="row">
                    @foreach ($categories as $category)
					<div class="col-md-4 col-xs-12 text-center">
	                    <div class="team-player">
                            <!-- featured_image_url , path creada en el modelo product::getFeaturedImageUrlAttribute -->
                            @if( $category -> image != "" )
	                           <img src="/images/categories/{{ $category -> image }}" alt="Thumbnail Image" class="img-rounded cout-size">
                            @else
                                <img src="/images/categories/default2.jpg" alt="Thumbnail Image" class="img-rounded cout-size">
                            @endif
	                        <h4 class="title">
                                <a href="{{ url('/categories/'.$category -> id) }}">{{ $category -> name }} </a><br />
							</h4>
	                        <p class="description">{{ $category->description }}</p>
	                    </div>
	                </div>
                    @endforeach
				</div>
			</div>
        </div>

        <div class="section text-center section-landing">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="title">¿Por qué confiar en RicoMar Online?</h2>
                    <h5 class="description">Puedes revisar nuestra relación completa de productos, comparar precios y realizar tus pedidos cuando estés seguro.</h5>
                </div>
            </div>

			<div class="features">
				<div class="row">
                    <div class="col-md-4">
						<div class="info">
							<div class="icon icon-primary">
								<i class="material-icons">chat</i>
							</div>
							<h4 class="info-title">Atendemos tus dudas</h4>
							<p>Atendemos rápidamente cualquier consulta que tengas vía chat. No estás sólo, sino que siempre estamos atentos a tus inquietudes.</p>
						</div>
                    </div>
                    <div class="col-md-4">
						<div class="info">
							<div class="icon icon-success">
								<i class="material-icons">verified_user</i>
							</div>
							<h4 class="info-title">Pago seguro</h4>
							<p>Todo pedido que realices será confirmado a través de una llamada. Si no confías en los pagos en línea puedes pagar contra entrega el valor acordado.</p>
						</div>
                    </div>
                    <div class="col-md-4">
						<div class="info">
							<div class="icon icon-danger">
								<i class="material-icons">fingerprint</i>
							</div>
							<h4 class="info-title">Información privada</h4>
							<p>Los pedidos que realices sólo los conocerás tú a través de tu panel de usuario. Nadie más tiene acceso a esta información.</p>
						</div>
                    </div>
                </div>
			</div>
        </div>
        <!-- si no esta logueado que lo deje inscribir -->
        @if( !(auth() -> check() ) )
            <div class="section landing-section">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 class="text-center title">¿Aún no te has registrado?</h2>
                        <h4 class="text-center description">Regístrate ingresando tus datos básicos, y podrás realizar tus pedidos a través de nuestro carrito de compras. Si aún no te decides, de todas formas, con tu cuenta de usuario podrás hacer todas tus consultas sin compromiso.</h4>
                        <form class="contact-form" action="{{ url( '/register' ) }}" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Correo electrónico</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group label-floating">
                                <label class="control-label">Tu mensaje</label>
                                <textarea class="form-control" rows="4"></textarea>
                            </div> -->

                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 text-center">
                                    <button class="btn btn-primary btn-raised">
                                        Iniciar Registro
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        @endif
    </div>

</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            // constructs the suggestion engine
            var products = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              // `states` is an array of state names defined in "The Basics"
              // local: ['hola','hola2','prueba','prueba2','prueba3']
              prefetch : '{{ url( "/products/json" ) }}'
            });
            //inicializar typeahead para busqueda predictiva
            $('#search').typeahead({
                hint: true,
                highlight: true, //la palabra que vaya coincidiendo alumbre
                minLength: 1 //suegerencias de palabras a partir de 1 caracter
            },
            {
                name: 'products',
                source: products
            });
        });
    </script>
@endsection
