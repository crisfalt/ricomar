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
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

</div>

<div class="main main-raised">
	<div class="container">

    	<div class="section">
            <h2 class="title text-center">Mis Ordenes</h2>

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

            <ul class="nav nav-pills nav-pills-primary" role="tablist">
            	<li class="active">
            		<a href="#dashboard" role="tab" data-toggle="tab">
            			<i class="material-icons">dashboard</i>
            			Carrito de Compras
            		</a>
            	</li>
            	<li>
            		<a href="#tasks" role="tab" data-toggle="tab">
            			<i class="material-icons">list</i>
            			Pedidos Realizados
            		</a>
            	</li>
            </ul>
			<hr>
			<p>Tu carrito de compras tiene {{ auth() -> user() -> cart -> details -> count() }} productos</p>
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
								@foreach( auth() -> user() -> cart -> details as $detail)
								<tr>
									<td class="text-center">
										<img class="img-thumbnail rounded" src="{{ $detail -> product -> featured_image_url }}" alt="" height="250" width="250">
									</td>
									<td class="text-center">
										<a href="{{ url('/products/'.$detail -> product -> id) }}" target="_blank">{{ $detail -> product->name }}</a>
									</td>
									<td class="text-center">{{ $detail -> quantity }}</td>
									<td class="text-right">$ {{ $detail -> product->price }}</td>
									<td class="text-right">$ {{ ( $detail -> product->price ) * ( $detail -> quantity ) }}</td>
									<td class="td-actions text-right">
										<form method="post" action="{{ url('/cart') }}">
											{{ csrf_field() }}
											{{ method_field('DELETE') }}
											<input type="hidden" name="cart_detail_id" value="{{ $detail -> id }}">
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
								<tr>
									<th class="text-center" colspan="4">Total A Pagar</th>
									<td class="text-right">{{ $totalTemp }}</td>
								</tr>
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
						<form class="" action="{{ url('/order') }}" method="post">
							{{ csrf_field() }}
							<!-- valor total del carrito de compras -->
							<input type="hidden" name="total" value="{{ $totalTemp }}">
							<a href="{{ url('/') }}" class="btn btn-primary btn-round"><i class="material-icons">keyboard_arrow_left</i> Seguir Comprando</a>
							<button type="submit" class="btn btn-danger btn-round"><i class="material-icons">check_circle</i> Confirmar Compra</button>
						</form>
					<!-- </div> -->
				</div>
			</div>
        </div>

    </div>

</div>
<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
