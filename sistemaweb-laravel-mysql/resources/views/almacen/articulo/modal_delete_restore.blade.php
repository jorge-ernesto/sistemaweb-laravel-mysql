<!-- $('#modal_delete_1').modal('show'); -->

<!-- Modal -->
<div class="modal fade animated fadeIn" id="modal_delete_{{ $value->idarticulo }}"> <!-- Se agrego animated fadeIn -->
    <div class="modal-dialog" role="document">                    
        <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title">Desactivar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                ¿Desea desactivar el registro?
            </div>
            <div class="modal-footer">

                <form method="POST" action="{{ route('articulo.destroy', $value->idarticulo) }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="action" value="delete">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Desactivar</button>
                </form>

            </div>
        </div>        
    </div>
</div>

<!-- Modal -->
<div class="modal fade animated fadeIn" id="modal_restore_{{ $value->idarticulo }}">
    <div class="modal-dialog" role="document">                    
        <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title">Activar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                ¿Desea activar el registro?
            </div>
            <div class="modal-footer">

                <form method="POST" action="{{ route('articulo.destroy', $value->idarticulo) }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="action" value="restore">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Activar</button>
                </form>

            </div>
        </div>        
    </div>
</div>
