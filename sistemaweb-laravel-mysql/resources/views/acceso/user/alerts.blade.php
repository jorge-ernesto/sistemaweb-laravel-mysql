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
@if( $errors->any() )
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach    
        </ul>
    </div>
@endif           
{{-- Fin Errores --}}
