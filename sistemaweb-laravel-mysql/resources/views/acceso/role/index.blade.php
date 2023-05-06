@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Roles
            <a href="{{ route('role.create') }}" class="btn btn-primary">Crear</a>              
        </h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Roles</div>
            <div class="card-body">
                
                @include('acceso.role.alerts')
                                
                @include('acceso.role.search')  
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-primary" width="100%" cellspacing="0"> <!-- id="dataTable" -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Full Access</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Full Access</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($roles as $key=>$value)
                                <tr>
                                    <td>{{ $value->id }}</td>   
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->slug }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value['full-access'] }}</td>                                    
                                    <td>
                                        <a href="{{ route('role.edit', $value->id) }}" class="btn btn-success btn-sm">Editar</a>
                                        <form method="POST" action="{{ route('role.destroy', $value->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Estas seguro que quieres eliminar?');">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>                           
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        Mostrando registros del {{ $roles->firstItem() }} al {{ $roles->lastItem() }} de un total de {{ $roles->total() }} registros        
                        {{ $roles->links() }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
@endsection