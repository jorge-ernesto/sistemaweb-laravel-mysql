@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid">
        <h1 class="display-4 mt-4">Detalle de categoria:</h1>
        <h4>id: {{ $dataCategoria['idcategoria'] }}</h4>
        <h4>nombre: {{ $dataCategoria['nombre'] }}</h4>
        <h4>descripcion: {{ $dataCategoria['descripcion'] }}</h4>
        <h4>condicion: {{ $dataCategoria['condicion'] }}</h4>        
        <h2>
            <a class="btn btn-primary" href="{{ route('categoria.index') }}">Atras</a>    
        </h2>
    </div>
@endsection
