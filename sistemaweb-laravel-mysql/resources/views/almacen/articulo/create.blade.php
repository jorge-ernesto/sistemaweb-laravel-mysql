@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Artículos</h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Artículos</div>
            <div class="card-body">

                @include('almacen.articulo.alerts')

                <form method="POST" action="{{ route('articulo.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Categoría:</label>
                        <div class="col-md-5">
                            <select name="idcategoria" class="form-control selectpicker" data-live-search="true" data-size="5">
                                @foreach($dataCategoria as $item)
                                    <option value="{{ $item->idcategoria }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Código:</label>
                        <div class="col-md-5">
                            <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                        <div class="col-md-5">
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Stock:</label>
                        <div class="col-md-5">
                            <input type="text" name="stock" class="form-control" value="{{ old('stock') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Descripción:</label>
                        <div class="col-md-5">
                            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Imagen:</label>
                        <div class="col-md-5">
                            <div class="custom-file">
                                <input type="file" name="imagen" class="custom-file-input" id="customFile" lang="es">
                                <label class="custom-file-label" for="customFile">Seleccionar Archivo</label>
                            </div>
                        </div>
                    </div>
                    <h4>
                        <button type="submit" class="btn btn-primary">Crear Artículo</button>                        
                        <a href="{{ route('articulo.index') }}" class="btn btn-primary">Atras</a>    
                    </h4>
                </form>                    

            </div>
        </div>
    </div>
@endsection

@section('scripts') 
    <script>
        $('.custom-file-input').on('change', function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).parent()
                .find('.custom-file-label')
                .html(inputFile.files[0].name);
        });  
    </script>    
@endsection
