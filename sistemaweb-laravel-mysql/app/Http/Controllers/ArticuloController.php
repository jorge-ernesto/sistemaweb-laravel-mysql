<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;                             //Recuperando modelos, App es el namespace
use Illuminate\Support\Facades\DB;   //Recuperando resultados
use Illuminate\Support\Facades\Gate; //Usar Gate de acceso

class ArticuloController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'articulo.index');

        if($request){
            $searchText = $request->searchText;
            $dataArticulo = DB::table('articulo as a')
                                    ->join('categoria as c', 'a.idcategoria', '=', 'c.idcategoria')
                                    ->select('a.idarticulo', 'c.nombre as categoria', 'a.codigo', 'a.nombre', 'a.stock', 'a.descripcion', 'a.imagen', 'a.estado')                                                                                                                                                                                    
                                    ->where('a.codigo', 'LIKE', '%'.$searchText.'%')
                                    ->orWhere('a.nombre', 'LIKE', '%'.$searchText.'%')                                                                                                                                                                                
                                    ->orderBy('idarticulo', 'ASC')
                                    ->paginate('10');
            return view('almacen.articulo.index', compact('dataArticulo', 'searchText'));
        }
    }
    
    public function create()
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'articulo.create');

        $dataCategoria = DB::table('categoria')
                            ->where('condicion', '=', '1')
                            ->get();
        return view('almacen.articulo.create', compact('dataCategoria'));
    }
    
    public function store(Request $request)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'articulo.create');

        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request */
        $request->validate([
            "idcategoria" => "required",
            "codigo"      => "required|max:50",
            "nombre"      => "required|max:100",
            "stock"       => "required|numeric",
            "descripcion" => "required|max:512", 
            "imagen"      => "mimes:jpeg,jpg,bmp,png"
        ]);

        /* Guardamos articulo */
        $articuloNuevo              = new App\Articulo;
        $articuloNuevo->idcategoria = $request->idcategoria;
        $articuloNuevo->codigo      = $request->codigo;
        $articuloNuevo->nombre      = $request->nombre;
        $articuloNuevo->stock       = $request->stock;
        $articuloNuevo->descripcion = $request->descripcion;                
        /* Imagen */
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $file->move(public_path().'/assets/imagenes/articulos/', $file->getClientOriginalName());
            $articuloNuevo->imagen = $file->getClientOriginalName();
        }
        $articuloNuevo->estado      = 'Activo';
        $articuloNuevo->save();        
        return back()->with('mensaje', 'Articulo agregado');
    }
    
    public function show($id)
    {        
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'articulo.show');

        $dataArticulo = App\Articulo::findOrFail($id);
        return view('almacen.articulo.show', compact('dataArticulo'));
    }

    public function edit($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'articulo.edit');
        
        $dataCategoria = DB::table('categoria')
                            ->where('condicion', '=', '1')
                            ->get();
        $dataArticulo = App\Articulo::findOrFail($id);        
        return view('almacen.articulo.edit', compact('dataCategoria', 'dataArticulo'));
    }

    public function update(Request $request, $id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'articulo.edit');

        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request */
        $request->validate([
            "idcategoria" => "required",
            "codigo"      => "required|max:50",
            "nombre"      => "required|max:100",
            "stock"       => "required|numeric",
            "descripcion" => "required|max:512", 
            "imagen"      => "mimes:jpeg,jpg,bmp,png"
        ]);

        /* Guardamos articulo */
        $articuloActualizado              = App\Articulo::findOrFail($id);
        $articuloActualizado->idcategoria = $request->idcategoria;
        $articuloActualizado->codigo      = $request->codigo;
        $articuloActualizado->nombre      = $request->nombre;
        $articuloActualizado->stock       = $request->stock;
        $articuloActualizado->descripcion = $request->descripcion;                
        /* Imagen */
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $file->move(public_path().'/assets/imagenes/articulos/', $file->getClientOriginalName());
            $articuloActualizado->imagen = $file->getClientOriginalName();
        }
        $articuloActualizado->estado = 'Activo';
        $articuloActualizado->update();        
        return back()->with('mensaje', 'Articulo editado');
    }

    public function destroy(Request $request, $id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'articulo.destroy');

        /* Obtenemos todo el request */
        // return $request->all();

        /* Cambiar estado de articulo */
        if($request->action == "delete"){
            $articuloActualizado = App\Articulo::findOrFail($id);
            $articuloActualizado->estado = 'Inactivo';
            $articuloActualizado->update();
            return back()->with('mensaje_eliminado', 'Articulo desactivado');
        }elseif($request->action == "restore"){
            $articuloActualizado = App\Articulo::findOrFail($id);
            $articuloActualizado->estado = 'Activo';
            $articuloActualizado->update();
            return back()->with('mensaje', 'Articulo activado');
        }
    }
}
