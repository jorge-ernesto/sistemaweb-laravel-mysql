{{-- Alertas --}}
@if( session('mensaje') )
    <div class="alert alert-success">{{ session('mensaje') }}</div>
@endif

@if( session('mensaje_eliminado') )
    <div class="alert alert-danger">{{ session('mensaje_eliminado') }}</div>
@endif

@if( session('mensaje_rollback') )
    <div class="alert alert-danger">{{ session('mensaje_rollback') }}</div>
@endif
{{-- Fin Alertas --}}

{{-- Errores --}}
@error('nombre')
    <div class="alert alert-danger">El nombre es requerido</div>        
@enderror

@if( $errors->has('descripcion') )
    <div class="alert alert-danger">La descripción es requerida</div>
@endif    
{{-- Fin Errores --}}            
