@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Modulos
            <a href="{{ route('module.create') }}" class="btn btn-primary">Crear</a>              
        </h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Modulos</div>
            <div class="card-body">
                
                @include('acceso.module.alerts')
                                
                @include('acceso.module.search')  
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-primary" width="100%" cellspacing="0"> <!-- id="dataTable" -->
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Nombre</th>
                                <th>Fecha Creacion</th>
                                <th>Fecha Actualizacion</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Nombre</th>
                                <th>Fecha Creacion</th>
                                <th>Fecha Actualizacion</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($modules as $key=>$value)
                                <tr>
                                    {{-- <td>{{ $value->id }}</td> --}}
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->updated_at }}</td>                                    
                                    <td>
                                        <a href="{{ route('module.edit', $value->id) }}" class="btn btn-success btn-sm">Editar</a>
                                        <form method="POST" action="{{ route('module.destroy', $value->id) }}">
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
                        Mostrando registros del {{ $modules->firstItem() }} al {{ $modules->lastItem() }} de un total de {{ $modules->total() }} registros        
                        {{ $modules->links() }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
@endsection