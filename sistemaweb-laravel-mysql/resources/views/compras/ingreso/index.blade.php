@extends('layouts.plantilla')    

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Ingreso
            <a href="{{ route('ingreso.create') }}" class="btn btn-primary">Crear</a>              
        </h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Ingresos</div>
            <div class="card-body">
                
                @include('compras.ingreso.alerts')
                                
                @include('compras.ingreso.search')  
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-primary" width="100%" cellspacing="0"> <!-- id="dataTable" -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Proveedor</th>
                                <th>Tipo Comprobante</th>
                                <th>Serie Comprobante</th>
                                <th>Num. Comprobante</th>
                                <th>Fecha Hora</th>
                                <th>Impuesto</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Proveedor</th>
                                <th>Tipo Comprobante</th>
                                <th>Serie Comprobante</th>
                                <th>Num. Comprobante</th>
                                <th>Fecha Hora</th>
                                <th>Impuesto</th>
                                <th>Estado</th>
                                <th>Total</th>
                                <th>Opciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($dataIngreso as $key=>$value)
                                <tr>
                                    <td>
                                        <a href="{{ route('ingreso.show', $value->idingreso) }}">{{ $value->idingreso }}</a>                                        
                                    </td>
                                    <td>{{ $value->proveedor }}</td>
                                    <td>{{ $value->tipo_comprobante }}</td>
                                    <td>{{ $value->serie_comprobante }}</td>
                                    <td>{{ $value->num_comprobante }}</td>
                                    <td>{{ $value->fecha_hora }}</td>
                                    <td>{{ $value->impuesto }}</td>
                                    <td>
                                        @if( $value->estado == "Aceptado" )
                                            <span class="badge badge-primary">{{ $value->estado }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $value->estado }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->total }}</td>
                                    <td>
                                        <a href="{{ route('ingreso.show', $value->idingreso) }}" class="btn btn-success btn-sm">Ver</a>                                        
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_delete_{{ $value->idingreso }}">Eliminar</button>
                                        @include('compras.ingreso.modal_delete')
                                    </td>
                                </tr>                           
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        Showing {{ $dataIngreso->firstItem() }} to {{ $dataIngreso->lastItem() }} of {{ $dataIngreso->total() }} entries        
                        {{ $dataIngreso->links() }}
                    </div>
                </div>
                
            </div>
        </div>
    </div>    
@endsection
