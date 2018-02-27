@extends('layouts.app')

@section('title','Bienvenido a ' . config( 'app.name' ) )

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
		    width: 250px;
        }

        .font-description {
            font-size : 1.2em;
        }

        .font-bold {
            font-weight: bold; 
            font-style: bold;
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

        /* *{
            margin:0;
        } */

        #fixed {
            
            left: calc( 100% - 54px );
            top: cacl(100% - 10px );;
            color : red;
            font-size: 30px;
            position: fixed;

        }

    </style>
@endsection

@section('body-class','landing-page')

@section('cartFixed')
<a href="{{ url('/home') }}"><i id="fixed" class="material-icons">shopping_cart</i></a>
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('/img/fondo2.jpg');">
    <div class="container">
        <div class="row">
			<div class="col-md-6">
				<h1 class="title">Bienvenido a {{ config( 'app.name' ) }}</h1>
                <h3>Realiza tus pedidos en linea y te contactaremos para coordinar la entrega </h3>
                <p class="font-description font-bold">Atendemos Domicilios en Horario De :</p>
                <p class="font-description font-bold">Lunes a Sabados de 10:00 AM a 08:00 PM</p>
                <p class="font-description font-bold">Domingos y Festivos de 04:00 PM a 08:00 PM</p>
                <br />
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn btn-danger btn-raised btn-lg">
					<i class="fa fa-play"></i> Como Funciona?
				</a>
			</div>
        </div>
    </div>
</div>

<div class="main main-raised">
	<div class="container">   
    	<div class="section text-center">
            <div class="row">
                <div class="col-md-3 col-xs-3"><img src="{{ asset('img/logo2.png') }}" class="img-responsive" height="250px" width="250px" /></div>
                <div class="col-md-6 col-xs-7"><h2 class="title">Visita Nuestras Categorías</h2></div>
            </div>
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
                                <a href="{{ url('/categories/'.$category -> id) }}"><img src="/images/categories/{{ $category -> image }}" alt="Thumbnail Image" class="img-rounded cout-size"></a>
                            @else
                                <a href="{{ url('/categories/'.$category -> id) }}"><img src="/images/categories/default2.jpg" alt="Thumbnail Image" class="img-rounded cout-size"></a>
                            @endif
	                        <h4 class="title">
                                <a href="{{ url('/categories/'.$category -> id) }}">{{ $category -> name }} </a><br />
							           </h4>
	                        <p class="description font-description">{{ $category->description }}</p>
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
      							<p class="font-description">Atendemos rápidamente cualquier consulta que tengas vía chat. No estás sólo, sino que siempre estamos atentos a tus inquietudes.</p>
      						</div>
                          </div>
                          <div class="col-md-4">
      						<div class="info">
      							<div class="icon icon-success">
      								<i class="material-icons">verified_user</i>
      							</div>
      							<h4 class="info-title">Pago seguro</h4>
      							<p class="font-description">Todo pedido que realices será confirmado a través de una llamada. Si no confías en los pagos en línea puedes pagar contra entrega el valor acordado.</p>
      						</div>
                          </div>
                          <div class="col-md-4">
      						<div class="info">
      							<div class="icon icon-danger">
      								<i class="material-icons">fingerprint</i>
      							</div>
      							<h4 class="info-title">Información privada</h4>
      							<p class="font-description">Los pedidos que realices sólo los conocerás tú a través de tu panel de usuario. Nadie más tiene acceso a esta información.</p>
      						</div>
                          </div>
                      </div>
      			</div>
        </div>

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
    </div>

</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
@section('scripts')
    <script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
    <script>
        $(function () {
            // 
            var products = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              prefetch: '{{ url("/products/json") }}'
            });            

            // inicializar typeahead sobre nuestro input de búsqueda
            $('#search').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'products',
                source: products
            });
        });
    </script>
@endsection