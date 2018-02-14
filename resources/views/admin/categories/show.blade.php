@extends('layouts.app')

@section('title','Ver Categoria')

@section('styles')
	<style>

		.quarter {
			height: 400px;
			width: 400px;
		}
		/* estilo para que la imagen quede bien redonda */
		.rounded {
			height: 400px;
			width: 400px;
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
            <h2 class="title text-center">Categoria {{ $category -> name }}</h2>

			<div class="team">
				<div class="row">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre de la Categoria</label>
                                <input type="text" class="form-control" name="name" value="{{ $category -> name }}" readonly>
                            </div>
                        </div>
						<div class="col-sm-6">
							 <div class="form-group label-floating">
								<label class="control-label">Descripción</label>
								<input type="text" class="form-control" name="description" value="{{ $category -> description }}" readonly>
							</div>
						</div>

                    </div>
					<div class="row text-center">
						<!-- Aqui pone la imagen que sube -->
						<img src="/images/categories/{{ $category -> image }}" class="img quarter" id="image">
					</div>
					<br>
                    <div class="text-center">
                        <a href="{{ url('/admin/categories') }}" class="btn btn-primary"><i class="material-icons">chevron_left</i> Volver</a>
                    </div>
				</div>
			</div>

        </div>

    </div>

</div>

<!-- incluir el footer desde una vista en la carpeta includes -->
@include('includes.footer')
@endsection
