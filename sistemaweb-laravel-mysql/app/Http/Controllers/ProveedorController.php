<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App; //Recuperando modelos, App es el namespace
use Illuminate\Support\Facades\DB; //Recuperando resultados
use Illuminate\Support\Facades\Gate;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'proveedor.index');

        if($request){
            $searchText = $request->searchText;
            $dataPersona = DB::table('persona')
                                ->where('nombre', 'LIKE', '%'.$searchText.'%')->where('tipo_persona', '=', 'Proveedor')
                                ->orWhere('num_documento', 'LIKE', '%'.$searchText.'%')->where('tipo_persona', '=', 'Proveedor')
                                ->orderBy('idpersona', 'ASC')
                                ->paginate('10');
            return view('compras.proveedor.index', compact('dataPersona', 'searchText'));
        }
    }

    public function create()
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'proveedor.create');

        return view('compras.proveedor.create');
    }

    public function store(Request $request)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'proveedor.create');
            
        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request */
        $request->validate([
            // "tipo_persona"   => "required",
            "nombre"         => "required|max:100",
            "tipo_documento" => "required|max:20",
            "num_documento"  => "required|max:15|unique:persona",
            "direccion"      => "max:70",
            "telefono"       => "max:15",
            "email"          => "max:50|email|nullable"
        ]);

        /* Guardamos persona */
        $personaNueva                 = new App\Persona;
        $personaNueva->tipo_persona   = "Proveedor";
        $personaNueva->nombre         = $request->nombre;
        $personaNueva->tipo_documento = $request->tipo_documento;
        $personaNueva->num_documento  = $request->num_documento;
        $personaNueva->direccion      = $request->direccion;
        $personaNueva->telefono       = $request->telefono;
        $personaNueva->email          = $request->email;
        $personaNueva->save();        
        return back()->with('mensaje', 'Proveedor agregado');
    }

    public function show($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'proveedor.show');

        $dataPersona = App\Persona::findOrFail($id);
        return view('compras.proveedor.show', compact('dataPersona'));
    }

    public function edit($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'proveedor.edit');

        $dataPersona = App\Persona::findOrFail($id);
        return view('compras.proveedor.edit', compact('dataPersona'));
    }

    public function update(Request $request, $id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'proveedor.edit');

        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request */
        $request->validate([
            // "tipo_persona"   => "required",
            "nombre"         => "required|max:100",
            "tipo_documento" => "required|max:20",
            "num_documento"  => "required|max:15|unique:persona,num_documento,$id,idpersona",
            "direccion"      => "max:70",
            "telefono"       => "max:15",
            "email"          => "max:50|email|nullable"
        ]);

        /* Guardamos persona */
        $personaActualizada                 = App\Persona::findOrFail($id);
        $personaActualizada->tipo_persona   = "Proveedor";
        $personaActualizada->nombre         = $request->nombre;
        $personaActualizada->tipo_documento = $request->tipo_documento;
        $personaActualizada->num_documento  = $request->num_documento;
        $personaActualizada->direccion      = $request->direccion;
        $personaActualizada->telefono       = $request->telefono;
        $personaActualizada->email          = $request->email;
        $personaActualizada->update();        
        return back()->with('mensaje', 'Proveedor editado');
    }

    public function destroy($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'proveedor.destroy');

        /* Eliminar persona */
        $personaActualizada = App\Persona::findOrFail($id);        
        $personaActualizada->delete();
        return back()->with('mensaje_eliminado', 'Proveedor eliminado'); 
    }
}
