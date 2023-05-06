@extends('layouts.plantilla')

@section('contenido')
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Categorías
            <a href="{{ route('categoria.create') }}" class="btn btn-primary">Crear</a>
        </h1>
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Categorías</div>
            <div class="card-body">

                @include('almacen.categoria.alerts')

                @include('almacen.categoria.search')
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-primary" width="100%" cellspacing="0"> <!-- id="dataTable" -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($dataCategoria as $key=>$value)
                                <tr>
                                    <td>
                                        <a href="{{ route('categoria.show', $value->idcategoria) }}">{{ $value->idcategoria }}</a>
                                    </td>
                                    <td>{{ $value->nombre }}</td>
                                    <td>{{ $value->descripcion }}</td>
                                    <td>
                                        <a href="{{ route('categoria.edit', $value->idcategoria) }}" class="btn btn-success btn-sm">Editar</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete_{{ $value->idcategoria }}">Eliminar</button>
                                        @include('almacen.categoria.modal_delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        Showing {{ $dataCategoria->firstItem() }} to {{ $dataCategoria->lastItem() }} of {{ $dataCategoria->total() }} entries
                        {{ $dataCategoria->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
