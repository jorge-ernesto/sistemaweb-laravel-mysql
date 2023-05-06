@extends('layouts.plantilla')

@section('contenido')    
    <div class="container-fluid text-primary">
        <h1 class="mt-4">Ingresos</h1>        
        <div class="card border-primary mb-4">
            <div class="card-header"><i class="fas fa-table mr-1"></i>Ingresos</div>
            <div class="card-body">

                @include('compras.ingreso.alerts')

                <form method="POST" action="{{ route('ingreso.store') }}">
                    @csrf
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Proveedor:</label>
                        <div class="col-md-5">
                            <select name="idproveedor" class="form-control">
                                @foreach($dataPersona as $item)
                                    <option value="{{ $item->idpersona }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Tipo de comprobante:</label>
                        <div class="col-md-5">
                            <select name="tipo_comprobante" class="form-control">
                                <option value="Boleta">Boleta</option>
                                <option value="Factura">Factura</option>                                
                                <option value="Ticket">Ticket</option>                                
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Serie de comprobante:</label>
                        <div class="col-md-5">
                            <input type="text" name="serie_comprobante" class="form-control" value="Synthesis 001" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="descripcion" class="col-form-label col-md-2">Numero de comprobante:</label>
                        <div class="col-md-5">
                            <input type="text" name="num_comprobante" class="form-control" value="Autogenerado" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-2">Impuesto:</label>
                        <div class="col-md-5">
                            <input type="text" name="impuesto" class="form-control" value="18" pattern="[-+]?[0-9]*[.]?[0-9]+" required placeholder="Impuesto"> {{-- type="number" min="1" step="any" required --}}
                        </div>
                    </div>

                    <div class="card border-primary mb-3">                        
                        <div class="card-body">
                            
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="nombre">Articulo</label>
                                    <select class="form-control selectpicker" data-live-search="true" data-size="5" id="idarticulo">
                                        @foreach($dataArticulo as $item)
                                            <option value="{{ $item->idarticulo }}">{{ $item->articulo }}</option>
                                        @endforeach                                                                    
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nombre">Cantidad</label>
                                    <input type="number" class="form-control" value="1" min="1" required placeholder="Cantidad" 
                                           id="cantidad">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nombre">Precio compra</label>
                                    <input type="text" class="form-control" value="1" pattern="[-+]?[0-9]*[.]?[0-9]+" required placeholder="Precio compra" {{-- type="number" min="1" step="any" required --}}
                                           id="precio_compra">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="nombre">Precio venta</label>
                                    <input type="text" class="form-control" value="1" pattern="[-+]?[0-9]*[.]?[0-9]+" required placeholder="Precio venta" {{-- type="number" min="1" step="any" required --}}
                                           id="precio_venta">
                                </div>
                                <a class="btn btn-primary btn-sm" href="javascript:agregar()">Agregar</a>
                            </div>

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-hover table-sm text-primary">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio compra</th>
                                    <th>Precio venta</th>                                    
                                    <th>Total</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>                            
                            <tbody id="cargarDetalle">
                            </tbody>
                        </table>
                    </div>
                    <h5 class="float-right clearfix">Total
                        <span class="badge badge-primary" id="granTotal">Total</span>
                    </h5>

                    <h4>
                        <button type="submit" class="btn btn-primary">Crear Ingreso</button>
                        <a href="{{ route('ingreso.index') }}" class="btn btn-primary">Atras</a>
                    </h4>
                </form>                    

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if( session('mensaje_rollback') || $errors->any() )
        <script>
            $('#cargarDetalle').append(localStorage.getItem('ingresodetalle'));
        </script>
    @endif

    <script>
        function agregar() {
            idarticulo    = $('#idarticulo').val();
            nombre        = $('.filter-option-inner-inner').text();
            cantidad      = $('#cantidad').val();
            precio_compra = $('#precio_compra').val();
            precio_venta  = $('#precio_venta').val();

            if (hasProducto(idarticulo)) {
                incrementaCantidad(idarticulo);
                return false; // No ejecuta el siguiente método, como un else
            }

            var response = '<tr id="row_'+ idarticulo +'">' +
                                '<td class="d-none">' +
                                    '<input type="hidden" name="idarticulo[]" value="'+ idarticulo +'">' +
                                '</td>' +
                                '<td>'+ nombre +'</td>' +
                                '<td style="width: 190px;">' +
                                    '<input type="number" name="cantidad[]" class="form-control col-sm-8" value="'+ cantidad +'" min="1" required onkeyup="calcularImporte('+ idarticulo +');" onchange="calcularImporte('+ idarticulo +');"' + " " +
                                            'id="cantidad_'+ idarticulo +'">' +
                                '</td>' +
                                '<td style="width: 220px;">' +
                                    '<input type="text" name="precio_compra[]" class="form-control col-sm-8" value="'+ precio_compra +'" pattern="[-+]?[0-9]*[.]?[0-9]+" required onkeyup="calcularImporte('+ idarticulo +');" onchange="calcularImporte('+ idarticulo +');"' + " " +
                                            'id="precio_compra_'+ idarticulo +'">' +
                                '</td>' +
                                '<td style="width: 220px;">' +
                                    '<input type="text" name="precio_venta[]" class="form-control col-sm-8" value="'+ precio_venta +'" pattern="[-+]?[0-9]*[.]?[0-9]+" required' + " " +
                                            'id="precio_venta_'+ idarticulo +'">' +
                                '</td>' +
                                '<td>' +
                                    '<span id="totalImporte_'+ idarticulo +'">1</span>' +
                                '</td>' +
                                '<td>' +
                                    '<button type="button" class="btn btn-sm btn-dark" onclick="eliminar(' + idarticulo + ');">Eliminar</button>' +
                                '</td>' +
                            '</tr>';
            $('#cargarDetalle').append(response);     
    
            calcularImporte(idarticulo);
        }

        function hasProducto(id) {
            var resultado = false;

            $('input[name="idarticulo[]"]').each(function() { // Referenciamos cada input que tenga name="idarticulo[]"
                if( parseInt(id) == parseInt($(this).val()) ) {
                    resultado = true;
                }
            });

            return resultado;
        }

        function incrementaCantidad(id) {
            var cantidad = $('#cantidad_' + id).val() ? parseInt($('#cantidad_' + id).val()) : 0;
            $('#cantidad_' + id).val(++cantidad);
            calcularImporte(id);
        }

        function calcularImporte(id) {
            var precio = $('#precio_compra_' + id).val();
            var cantidad = $('#cantidad_' + id).val();
            $('#totalImporte_' + id).text((parseFloat(precio) * parseInt(cantidad)).toFixed(2));
            calcularGranTotal();            
        }

        function calcularGranTotal() {
            var total = 0;
            $('span[id^="totalImporte_"]').each(function() { // All elements with a title attribute value starting with "totalImporte_"
                total += parseFloat($(this).text());
            });
            $('#granTotal').text(total.toFixed(2));
        }

        function eliminar(id) {
            $('#row_' + id).remove();
            calcularGranTotal();
        }        

        /* Envio del formulario */
        $("button[type=submit]").on('click', function(){
            ingresodetalle();
        })

        /* Ingreso detalle */
        function ingresodetalle() {
            /* Actualizar values */
            $('input[name="cantidad[]"]').each(function() {
                $(this).attr('value', $(this).val());
            });

            $('input[name="precio_compra[]"]').each(function() {
                $(this).attr('value', $(this).val());
            });

            $('input[name="precio_venta[]"]').each(function() {
                $(this).attr('value', $(this).val());
            });

            /* Ingreso detalle */
            ingreso_detalle = $('#cargarDetalle').html();
            localStorage.setItem('ingresodetalle', ingreso_detalle);
            console.log('ingresodetalle', localStorage.getItem('ingresodetalle'));
        }
    </script>
@endsection