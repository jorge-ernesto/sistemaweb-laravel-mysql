@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Ingresos</h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Ingresos</div>
            <div class="card-body">

                @include('compras.ingreso.alerts')

                {{-- <form method="POST" action="{{ route('ingreso.store') }}"> --}}
                    {{-- @csrf --}}
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Proveedor:</label>
                        <div class="col-md-5">
                            <select name="idproveedor" class="form-control">
                                @foreach($dataPersona as $item)
                                    @if($item->idpersona == $dataIngreso->idproveedor)
                                        <option value="{{ $item->idpersona }}" selected>{{ $item->nombre }}</option>
                                    @else
                                        <option value="{{ $item->idpersona }}">{{ $item->nombre }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Tipo de comprobante:</label>
                        <div class="col-md-5">
                            <select name="tipo_comprobante" class="form-control">
                                @if($dataIngreso->tipo_comprobante == "Boleta")
                                    <option value="Boleta" selected>Boleta</option>
                                    <option value="Factura">Factura</option>                                
                                    <option value="Ticket">Ticket</option>            
                                @elseif($dataIngreso->tipo_comprobante == "Factura")
                                    <option value="Boleta">Boleta</option>
                                    <option value="Factura" selected>Factura</option>                                
                                    <option value="Ticket">Ticket</option>
                                @elseif($dataIngreso->tipo_comprobante == "Ticket")
                                    <option value="Boleta">Boleta</option>
                                    <option value="Factura">Factura</option>                                
                                    <option value="Ticket" selected>Ticket</option>
                                @endif 
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Serie de comprobante:</label>
                        <div class="col-md-5">
                            <input type="text" name="serie_comprobante" class="form-control" value="{{ $dataIngreso->serie_comprobante }}" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Numero de comprobante:</label>
                        <div class="col-md-5">
                            <input type="text" name="num_comprobante" class="form-control" value="{{ $dataIngreso->num_comprobante }}" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Impuesto:</label>
                        <div class="col-md-5">
                            <input type="text" name="impuesto" class="form-control" value="{{ $dataIngreso->impuesto }}" pattern="[-+]?[0-9]*[.]?[0-9]+" required placeholder="Impuesto"> {{-- type="number" min="1" step="any" required --}}
                        </div>
                    </div>

                    <div class="card border-primary mb-3">                        
                        <div class="card-body">

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm text-primary">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio compra</th>
                                    <th>Precio venta</th>                                    
                                    <th>Total</th>
                                </tr>
                            </thead>                            
                            <tbody id="cargarDetalle">
                                @foreach($dataDetalle as $key=>$value)
                                <tr id="row_1">
                                    <td class="d-none">
                                        <input type="hidden" name="idarticulo[]" value="{{ $value->idarticulo }}">
                                    </td>
                                    <td>{{ $value->articulo }}</td>
                                    <td style="width: 190px;">
                                        <input type="number" name="cantidad[]" class="form-control col-sm-8" value="{{ $value->cantidad }}" min="1" required onkeyup="calcularImporte(1);" onchange="calcularImporte(1);" id="cantidad_1">
                                    </td>
                                    <td style="width: 220px;">
                                        <input type="text" name="precio_compra[]" class="form-control col-sm-8" value="{{ $value->precio_compra }}" pattern="[-+]?[0-9]*[.]?[0-9]+" required onkeyup="calcularImporte(1);" onchange="calcularImporte(1);" id="precio_compra_1">
                                    </td>
                                    <td style="width: 220px;">
                                        <input type="text" name="precio_venta[]" class="form-control col-sm-8" value="{{ $value->precio_venta }}" pattern="[-+]?[0-9]*[.]?[0-9]+" required id="precio_venta_1">
                                    </td>
                                    <td><span id="totalImporte_1">{{ $value->total }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h5 class="float-right clearfix">Total
                        <span class="badge badge-primary" id="granTotal">{{ $dataIngreso->total }}</span>
                    </h5>

                    <h4>
                        {{-- <button type="submit" class="btn btn-primary">Crear Ingreso</button> --}}
                        <a href="{{ route('ingreso.index') }}" class="btn btn-primary">Atras</a>
                    </h4>
                {{-- </form> --}}

            </div>
        </div>
    </div>
@endsection
