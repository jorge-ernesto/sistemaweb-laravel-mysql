@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Modulos</h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Modulos</div>
            <div class="card-body">

                @include('acceso.module.alerts')

                <form method="POST" action="{{ route('module.store') }}">
                    @csrf
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                        <div class="col-md-5">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>

                    <h4>
                        <button type="submit" class="btn btn-primary">Crear Modulo</button>                        
                        <a href="{{ route('module.index') }}" class="btn btn-primary">Atras</a>    
                    </h4>
                </form>                    

            </div>
        </div>
    </div>
    <!-- Verificar los datos de regreso (old), dd detiene la ejecucion -->
    {{-- {{ dd(old()) }} --}}
@endsection