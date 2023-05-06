<form method="GET" action="{{ route('categoria.index') }}">
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" name="searchText" placeholder="Buscar" value="{{ $searchText }}">        
            <button type="submit" class="btn btn-primary ml-2">Buscar</button>    
        </div>
    </div>
</form>
