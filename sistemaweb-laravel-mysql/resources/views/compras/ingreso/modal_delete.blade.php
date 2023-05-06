<!-- $('#modal_delete_1').modal('show'); -->

<!-- Modal -->
<div class="modal fade animated fadeIn" id="modal_delete_{{ $value->idingreso }}"> <!-- Se agrego animated fadeIn -->
    <div class="modal-dialog" role="document">                    
        <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                ¿Desea eliminar el registro?
            </div>
            <div class="modal-footer">

                <form method="POST" action="{{ route('ingreso.destroy', $value->idingreso) }}">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>

            </div>
        </div>        
    </div>
</div>
