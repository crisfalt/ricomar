@extends('layouts.app')

@section('title','Listado de Categorias')

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
    	<div class="section text-center">
            <h2 class="title">Lista de Categorias</h2>

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
                    <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary btn-round"><i class="material-icons">create</i> Nueva Categoria</a>
                    <!-- <br> -->
                    <hr>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-3 text-center">Nombre</th>
                                <th class="col-md-6 text-center">Descripción</th>
                                <th class="text-center">Imagen</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $categorie)
                            <tr>
                                <td>{{ $categorie->name }}</td>
                                <td>{{ $categorie->description }}</td>
                                <td>
									@if( $categorie -> image != "" )
										<img class="img-thumbnail rounded" src="/images/categories/{{ $categorie -> image }}">
									@else
										<img class="img-thumbnail rounded" src="/images/categories/default2.jpg">
									@endif
								</td>
                                <td class="td-actions text-right">
                                    <form method="post" action="{{ url('/admin/categories/'.$categorie->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <a href="{{ url('/admin/categories/'.$categorie->id) }}" rel="tooltip" title="Ver Categoria" class="btn btn-info btn-simple btn-xs"*>
                                            <i class="fa fa-info"></i>
                                        </a>
                                        <a href="{{ url('/admin/categories/'.$categorie->id.'/edit') }}" rel="tooltip" title="Editar Categoria" class="btn btn-success btn-simple btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <!-- <a href="{{ url('/admin/categories/'.$categorie->id.'/images') }}" rel="tooltip" title="Imágenes de la Categoria" class="btn btn-warning btn-simple btn-xs">
                                            <i class="fa fa-image"></i>
                                        </a> -->
                                        <button type="submit" rel="tooltip" title="Eliminar Categoria" class="btn btn-danger btn-simple btn-xs">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- para mostrar la paginacion hecha en el controlador -->
                    {{ $categories -> links() }}
				</div>
			</div>

        </div>
    </div>

</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
