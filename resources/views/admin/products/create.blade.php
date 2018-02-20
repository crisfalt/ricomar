@extends('layouts.app')

@section('title','Registrar Producto')

@section('body-class','profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/fondo2.jpg') }}');">

</div>

<div class="main main-raised">
	<div class="container">

    	<div class="section">
            <h2 class="title text-center">Registrar Nuevo Producto</h2>

			<div class="team">
				<div class="row">
                    <!-- Mostrar los errores capturados por validate -->
                    @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ url('/admin/products') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
                                <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group label-floating">
                                <label class="control-label">Descripción corta</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Categoría del producto</label>
                                <select class="form-control" name="category_id">
									<option class="form-control" value="0">General</option>
									@foreach( $categories as $categorie )
										<option value="{{ $categorie -> id }}">{{ $categorie -> name }}</option>
									@endforeach
                                </select>
                            </div>
                        </div>
                    </div>



                    <textarea class="form-control" placeholder="Descripción extensa del producto" rows="5" name="long_description">{{ old('long_description') }}</textarea>
                    <div class="text-center">
                        <button class="btn btn-danger">Registrar producto</button>
                        <a href="{{ url('/admin/products') }}" class="btn btn-default">Cancelar</a>
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
