@extends('layouts.app')

@section('title','Listado de Productos')

@section('styles')

<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.foundation.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.foundation.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.foundation.min.css" rel="stylesheet" /> -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet" /> -->
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css" rel="stylesheet" />


@endsection

@section('body-class','profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/fondo2.jpg') }}');">

</div>

<div class="main main-raised">
	<div class="container">
    	<div class="section text-center">
            <h2 class="title">Lista de Productos</h2>

			<div class="team">
				<div class="row">
					<!-- mostrar mensaje del controlador -->
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
                    <a href="{{ url('/admin/products/create') }}" class="btn btn-danger btn-round">Nuevo producto</a>
                    <!-- <br> -->
                    <hr>



                    <table class="table" cellspacing="0" id="tableProducts">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Nombre</th>
                                <th class="col-md-4 text-center">Descripción</th>
                                <th class="col-md-2 text-center">Categoría</th>
                                <th class="col-md-1 text-right">Precio</th>
                                <th class="col-md-3 text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->long_description }}</td>
                                <!-- operador ? para preguntar por un parametro existe si no muesta 'general' -->
                                <!-- <td>{{ $product->category ? $product->category->name : 'General' }}</td> -->
								<td>{{ $product->category_name }}</td>
                                <td class="text-right">$ {{ $product->price }}</td>
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/admin/products/'.$product->id) }}" class="delete">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <a href="{{ url('/products/'.$product->id) }}" rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
                                            <i class="fa fa-info"></i>
                                        </a>
                                        <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" rel="tooltip" title="Editar producto" class="btn btn-success btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ url('/admin/products/'.$product->id.'/images') }}" rel="tooltip" title="Imágenes del producto" class="btn btn-warning btn-simple btn-xs">
                                            <i class="fa fa-image"></i>
                                        </a>
                                        <a class='btn btn-danger btn-simple btn-xs' rel="tooltip" title="Eliminar" onclick="Delete('{{ $product -> name }}')"><i class='fa fa-times'></i> </a>
                                        <!-- <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button> -->
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- para mostrar la paginacion hecha en el controlador -->
                    {{--{{ $products -> links() }}--}}
				</div>
			</div>

        </div>
    </div>

</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection

@section('scripts')
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> 
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>

    <script>
        function Delete( nameProduct ) {
			$.confirm({
				theme: 'supervan',
				title: 'Eliminar Plato',
				content: 'Seguro(a) que deseas eliminar el Plato ' + nameProduct + '. <br> Click Aceptar or Cancelar',
				icon: 'fa fa-question-circle',
				animation: 'scale',
				animationBounce: 2.5,
				closeAnimation: 'scale',
				opacity: 0.5,
				buttons: {
					'confirm': {
						text: 'Aceptar',
						btnClass: 'btn-blue',
						action: function () {
							$.confirm({
								theme: 'supervan',
								title: 'Estas Seguro ?',
								content: 'Una vez eliminado debes volver a crear el plato',
								icon: 'fa fa-warning',
								animation: 'scale',
								animationBounce: 2.5,
								closeAnimation: 'zoom',
								buttons: {
									confirm: {
										text: 'Si, Estoy Seguro!',
										btnClass: 'btn-orange',
										action: function () {
											$('.delete').submit();
										}
									},
									cancel: {
										text: 'No, Cancelar',
										//$.alert('you clicked on <strong>cancel</strong>');
									}
								}
							});
						}
					},
					cancel: {
						text: 'Cancelar',
						//$.alert('you clicked on <strong>cancel</strong>');
					},
				}
			});
		}
    </script>
    <script>
        $(document).ready(function() {
            $('#tableProducts').DataTable({
                "language": {

                    "emptyTable": "No hay productos , click en el boton <b>Nuevo Producto</b> para agregar uno nuevo",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "previous": "Anterior",
                        "next": "Siguiente",
                    },
                    "search": "Buscar: ",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                    "lengthMenu": "Mostrar _MENU_ Productos por Página",
                    "zeroRecords": "No se encontro ningun resultado",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                },
                "responsive" : "true",
                "autoWidth": "true"
            });
        });
    </script>
@endsection
