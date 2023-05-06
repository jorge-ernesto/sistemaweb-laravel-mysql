@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Usuarios
            <a href="{{ route('user.create') }}" class="btn btn-primary">Crear</a>              
        </h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Usuarios</div>
            <div class="card-body">
                
                @include('acceso.user.alerts')
                                
                @include('acceso.user.search')  
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-primary" width="100%" cellspacing="0"> <!-- id="dataTable" -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Creacion</th>
                                <th>Fecha Actualizacion</th>
                                <th>Roles</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Fecha Creacion</th>
                                <th>Fecha Actualizacion</th>
                                <th>Roles</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($dataUsuario as $key=>$value)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.show', $value->id) }}">{{ $value->id }}</a>
                                    </td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->updated_at }}</td>
                                    <td>{{ $value->role_name }}</td>
                                    <td>
                                        <a href="{{ route('user.edit', $value->id) }}" class="btn btn-success btn-sm">Editar</a>
                                        <a href="{{ route('user.passwordEdit', $value->id) }}" class="btn btn-success btn-sm">Cambiar contraseña</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete_{{ $value->id }}">Eliminar</button>
                                        @include('acceso.user.modal_delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        Showing {{ $dataUsuario->firstItem() }} to {{ $dataUsuario->lastItem() }} of {{ $dataUsuario->total() }} entries        
                        {{ $dataUsuario->links() }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
@endsection
