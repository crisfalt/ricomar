@extends('layouts.app')

@section('title','Registrar Producto')

@section('body-class','profile-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/fondo2.jpg') }}');">

</div>

<div class="main main-raised">
	<div class="container">

    	<div class="section">
            <h2 class="title text-center">Editar Producto {{ $product -> name }}</h2>

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
                    <form method="post" action="{{ url('/admin/products/'.$product->id.'/edit') }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio del producto</label>
								<!-- step=0.01 permite guardar numeros flotantes segun los decimales -->
                                <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $product->price) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- <div class="col-sm-6">
                             <div class="form-group label-floating">
                                <label class="control-label">Descripción corta</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description', $product->description) }}">
                            </div>
                        </div> -->

						<div class="col-sm-4">
                            <div class="form-group label-floating">
                                <label class="control-label">Categoría del producto</label>
                                <select class="form-control" name="category_id">
									<option class="form-control" value="0" selected>General</option>
									@foreach( $categories as $categorie )
											<option value="{{ $categorie -> id }}" @if( $categorie -> id == old( 'category_id', $product -> category_id ) )  selected @endif>{{ $categorie -> name }}</option>
									@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" placeholder="Descripción extensa del producto" rows="5" name="long_description">{{ old('long_description',$product->long_description) }}</textarea>
                        </div>
                    </div>



                    <!-- <textarea class="form-control" placeholder="Descripción extensa del producto" rows="5" name="long_description">{{ old('long_description', $product->long_description) }}</textarea> -->
                    <div class="text-center">
                        <button class="btn btn-danger">Actualizar Producto</button>
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
