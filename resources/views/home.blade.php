@extends('layouts.app')

@section('title','RicoMar | Dashboard')

@section('styles')
	<style>
		/* estilo para que la imagen quede bien redonda */
		.rounded {
			height: 80px;
			width: 80px;
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
            <h2 class="title text-center">Mis Ordenes</h2>

            @if ( $notification != "" )
				<div class="alert alert-success">
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
            @endif

            <ul class="nav nav-pills nav-pills-danger" role="tablist">
            	<li class="active">
            		<a href="#dashboard" role="tab" data-toggle="tab">
            			<i class="material-icons">dashboard</i>
            			Carrito de Compras
            		</a>
            	</li>
				<!-- Lista de los pedidos que ha realizado un cliente -->
            	<!-- <li>
            		<a href="#tasks" role="tab" data-toggle="tab">
            			<i class="material-icons">list</i>
            			Pedidos Realizados
            		</a>
            	</li> -->
            </ul>
			<hr>
			<p>Se cobra un valor adiccional de $1000 que corresponde al embalaje del producto</p>
			<hr>
			<?php
				$cartDetails;
				$countProducts = 0;
				if( auth() ->check() ) {
					$cartDetails = auth() -> user() -> cart -> details;
					$countProducts= $cartDetails -> count();
				}
				else {
					if( ( \Cache::has('detailsTemp') ) ) {
						$cartDetails = \Cache::get('detailsTemp');
						$countProducts = count($cartDetails);
					}
					else {
						$cartDetails = array();
					}
				}
			?>
			<p>Tu carrito de compras tiene {{ $countProducts }} productos</p>
			<div class="team">
				<div class="row">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="text-center">Producto</th>
									<th class="col-md-4 text-center">Nombre</th>
									<th class="text-center">Cantidad</th>
									<th class="text-right">Precio</th>
									<th class="text-right">SubTotal</th>
									<th class="text-right">Opciones</th>
								</tr>
							</thead>
							<tbody>
							<!-- variable para sumarla cantidad de cada plato pedido -->
								<?php
									$totalQuantity = 0; //cantidad que piden de un producto
									$addPlatos = array(); //los adiccionales que piden del ceviche
									$countAddicionales = 0; //variables para guardar la cantidad de datos addcicionales
									$totalPay = 0; //variable para total a pagar
								?>
								@foreach( $cartDetails as $key => $detail)
								<tr>
									<td class="text-center">
										<img class="img-thumbnail rounded" src="{{ $detail -> product -> featured_image_url }}" alt="" height="250" width="250">
									</td>
									<td class="text-center">
										@if( $detail -> observation != null  )
											<?php
												$addPlatos = explode(";",$detail->observation);
												$countAddicionales = count( $addPlatos );
											?>
											<a href="{{ url('/products/'.$detail -> product -> id) }}" target="_blank">{{ $detail -> product->name . " ( Adiccional : " . $detail -> observation .")" }}</a>	
										@else
											<a href="{{ url('/products/'.$detail -> product -> id) }}" target="_blank">{{ $detail -> product->name }}</a>
										@endif
									</td>
									<td class="text-center">{{ $detail -> quantity }}</td>
									<?php
										$totalQuantity += $detail -> quantity;
									?>
									@if( $countAddicionales > 0 )
										<td class="text-right">$ {{ ( $detail -> product->price ) + ( 2000 * $countAddicionales ) }}</td>
										<?php
											$totalPay += ( $detail -> product->price + ( 2000 * $countAddicionales ) ) * ( $detail -> quantity );
										?>
										<td class="text-right">$ {{ ( $detail -> product->price + ( 2000 * $countAddicionales ) ) * ( $detail -> quantity )  }}</td>
									@else
										<td class="text-right">$ {{ $detail -> product->price }}</td>
										<?php
											$totalPay += ( $detail -> product->price ) * ( $detail -> quantity );
										?>
										<td class="text-right">$ {{ ( $detail -> product->price ) * ( $detail -> quantity ) }}</td>
									@endif
									<td class="td-actions text-right">
										<form method="post" action="{{ url('/cart') }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											@if( auth() -> check() )
												<input type="hidden" name="cart_detail_id" value="{{ $detail -> id }}">
											@else
											<input type="hidden" name="cart_detail_id" value="{{ $key }}">
											@endif	
											<a href="{{ url('/products/'.$detail -> product->id) }}" target="_blank" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs" target="_blank">
												<i class="fa fa-info"></i>
											</a>
											<button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
												<i class="fa fa-times"></i>
											</button>
										</form>
									</td>
								</tr>
								@endforeach
								@if( $countProducts > 0 )
									<!-- la cantidad de platos del pedido por el valor de icopor -->
									<tr>
										<td class="text-center" colspan="3">Icopor y empaques para el domicilio</td>
										<td class="text-right">$ {{ ($totalQuantity * 1000) }}</td>
										<td class="text-right">$ {{ ($totalQuantity * 1000) }}</td>
									</tr>
									<tr>
										<th class="text-center" colspan="4">Total A Pagar</th>
										<!-- el total de los icopores por el subtotal de los platos -->
										<?php
											$totalPay += ($totalQuantity * 1000);
										?>
										<td class="text-right">$ {{ $totalPay }}</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="text-center">
					<!-- <div class="col-md-6"> -->
					<!-- </div>
					<div class="col-md-2"> -->
					@if( auth() -> check() )
						<form class="" action="{{ url('/order') }}" method="post">
							{{ csrf_field() }}
							<!-- valor total del carrito de compras -->
							<a href="{{ url('/') }}" class="btn btn-primary btn-round"><i class="material-icons">keyboard_arrow_left</i> Seguir Comprando</a>
							<input type="hidden" name="total" value="{{ $totalPay }}">
							<button type="submit" class="btn btn-danger btn-round"><i class="material-icons">check_circle</i> Confirmar Compra</button>
						</form>
					@else
						<a href="{{ url('/') }}" class="btn btn-primary btn-round"><i class="material-icons">keyboard_arrow_left</i> Seguir Comprando</a>
						<button class="btn btn-danger btn-round" data-toggle="modal" data-target="#addToCart"><i class="material-icons">check_circle</i> Confirmar Compra</button>
					@endif	
					<!-- </div> -->
				</div>
			</div>
        </div>

    </div>

</div>

<!-- modal para que pueda escoger la cantidad y porciones adiccionales -->
<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="myModalLabel">Datos Necesarios para el Domicilio</h4>
	  </div>
	  <form class="" action="{{ url('/order') }}" method="post">
		  {{ csrf_field() }}
		  <input type="hidden" name="total" value="{{ $totalPay }}">
		  <div class="modal-body">
		  	<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">face</i>
				</span>
				<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre Quien Recibe el Domicilio" required autofocus>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">email</i>
				</span>
				<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo Electronico (Opcional)">
			</div>

			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">phone</i>
				</span>
				<input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Telefono de Contacto" required>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
					<i class="material-icons">home</i>
				</span>
				<input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Direccion de Entrega" required>
			</div>
    	  </div>
    	  <div class="modal-footer">
    		<button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
    		<button type="submit" class="btn btn-info btn-simple">Confirmar Compra</button>
    	  </div>
	  </form>
	</div>
  </div>
</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
