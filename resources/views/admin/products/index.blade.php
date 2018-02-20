@extends('layouts.app')

@section('title','Listado de Productos')

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



                    <table class="table" id="tableProducts">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Nombre</th>
                                <th class="col-md-5 text-center">Descripción</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-right">Precio</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <!-- operador ? para preguntar por un parametro existe si no muesta 'general' -->
                                <!-- <td>{{ $product->category ? $product->category->name : 'General' }}</td> -->
								<td>{{ $product->category_name }}</td>
                                <td class="text-right">$ {{ $product->price }}</td>
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/admin/products/'.$product->id) }}">
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
                                        <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- para mostrar la paginacion hecha en el controlador -->
                    {{ $products -> links() }}
				</div>
			</div>

        </div>
    </div>

</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/js/foundation.min.js"></script>
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.foundation.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.foundation.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableProducts').DataTable({
                "language": {

                    "emptyTable": "No hay categorias , click en el boton <b>Nueva Categoria</b> para agregar uno nuevo",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "previous": "Anterior",
                        "next": "Siguiente",
                    },
                    "search": "Buscar: ",
                    "info": "Mostrando del _START_ al _END_, de un total de _TOTAL_ entradas",
                },
                "dom": 'Bfrtip',
                        "lengthChange": "false",
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            ['10 filas', '25 filas', '50 filas', 'Mostrar Todo']
                        ],
                        "buttons": [
                            {
                                "extend": "pageLength",
                                "text": "Mostrar Mas",
                                "orientation": 'landscape',
                                "pageSize": 'LEGAL'
                                //"className": "red"
                            },
                            {
                                "extend": "print",
                                "text": "<i class='fa fa-print'></i>",
                                "titleAttr": 'Imprimir',
                                "orientation": 'landscape',
                                "pageSize": 'LEGAL'
                                //"className": "red"
                            },
                            {
                                "extend": 'excelHtml5',
                                "text": '<i class="fa fa-file-excel-o"></i>',
                                "titleAttr": 'Convertir Excel',
                                //"extend": "excel",
                                //"text": "Convertir Excel",
                                "orientation": 'landscape',
                                "pageSize": 'LEGAL'
                            },
                            {
                                "extend": 'pdfHtml5',
                                "text": '<i class="fa fa-file-pdf-o"></i>',
                                "titleAttr": 'Convertir PDF',
                                "orientation": 'landscape',
                                "pageSize": 'LEGAL'
                                //"extend": "pdf",
                                //"text": "Convertir Pdf"
                                //"className": "red"
                            }
                        ]
            });
        } );
    </script>
@endsection
