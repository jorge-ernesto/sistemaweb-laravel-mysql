@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Clientes</h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Clientes</div>
            <div class="card-body">

                @include('ventas.cliente.alerts')

                <form method="POST" action="{{ route('cliente.store') }}">
                    @csrf
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Tipo persona:</label>
                        <div class="col-md-5">
                            <select name="tipo_persona" class="form-control">
                                <option value="Cliente" selected>Cliente</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                        <div class="col-md-5">
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Tipo documento:</label>
                        <div class="col-md-5">
                            <select name="tipo_documento" class="form-control">
                                <option value="DNI">DNI</option>
                                <option value="RUC">RUC</option>                                
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Numero documento:</label>
                        <div class="col-md-5">
                            <input type="text" name="num_documento" class="form-control" value="{{ old('num_documento') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Direccion:</label>
                        <div class="col-md-5">
                            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Telefono:</label>
                        <div class="col-md-5">
                            <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Email:</label>
                        <div class="col-md-5">
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                    </div>
                    <h4>
                        <button type="submit" class="btn btn-primary">Crear Cliente</button>                        
                        <a href="{{ route('cliente.index') }}" class="btn btn-primary">Atras</a>    
                    </h4>
                </form>                    

            </div>
        </div>
    </div>
@endsection
