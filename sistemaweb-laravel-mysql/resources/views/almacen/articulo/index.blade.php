@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Artículos
            <a href="{{ route('articulo.create') }}" class="btn btn-primary">Crear</a>              
        </h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Artículos</div>
            <div class="card-body">
                
                @include('almacen.articulo.alerts')
                                
                @include('almacen.articulo.search')  
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-primary" width="100%" cellspacing="0"> <!-- id="dataTable" -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Descripcion</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Descripcion</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($dataArticulo as $key=>$value)
                                <tr>
                                    <td>
                                        <a href="{{ route('articulo.show', $value->idarticulo) }}">{{ $value->idarticulo }}</a>
                                    </td>
                                    <td>{{ $value->categoria }}</td>
                                    <td>{{ $value->codigo }}</td>
                                    <td>{{ $value->nombre }}</td>
                                    <td>{{ $value->stock }}</td>
                                    <td>{{ $value->descripcion }}</td>
                                    <td>
                                        <div class="articulo_list">
                                            <img src="{{ asset('assets/imagenes/articulos/' . $value->imagen) }}" alt="">
                                        </div>                                        
                                    </td>
                                    <td>
                                        @if( $value->estado == "Activo" )
                                            <span class="badge badge-primary">{{ $value->estado }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $value->estado }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('articulo.edit', $value->idarticulo) }}" class="btn btn-success btn-sm">Editar</a>

                                        @if( $value->estado == "Activo" )                                    
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete_{{ $value->idarticulo }}">Desactivar</button>
                                        @else
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_restore_{{ $value->idarticulo }}">Activar</button>
                                        @endif                                        
                                        @include('almacen.articulo.modal_delete_restore')
                                    </td>
                                </tr>                           
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        Showing {{ $dataArticulo->firstItem() }} to {{ $dataArticulo->lastItem() }} of {{ $dataArticulo->total() }} entries        
                        {{ $dataArticulo->links() }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
@endsection
