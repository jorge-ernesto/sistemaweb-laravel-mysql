<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Module; //Recuperando modelos, App es el namespace
use Illuminate\Support\Facades\DB; //Recuperando resultados
use Illuminate\Support\Facades\Gate;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'module.index');

        if($request){
            $searchText = $request->searchText;
            $modules = Module::where('name', 'LIKE', '%'.$searchText.'%')
                            ->orderBy('name', 'ASC')
                            ->paginate('10');
            return view('acceso.module.index', compact('modules', 'searchText'));
        }
    }
    
    public function create()
    {        
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'module.create');

        return view('acceso.module.create');
    }
    
    public function store(Request $request)
    {               
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'module.create');
        
        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request */
        $request->validate([
            "name" => "required|max:50|unique:modules,name"
        ]);
                
        try{
            DB::beginTransaction();            
                
            /* Guardamos modulo */
            $module = Module::create($request->all());                         
                        
            /* Obtener permisos autogenerados por modulo creado */
            $permisos_autogenerados = $this->get_permisos_autogenerados($request, $module);   

            /* Guardamos permisos autogenerados por modulo creado */          
            if(!empty($module) && is_object($module) && isset($module)){                                               
                foreach ($permisos_autogenerados as $key=>$permiso) {
                    $module->permissions()->create( $permiso );
                }                          
            }                                  
             
            DB::commit();
            return back()->with('mensaje', 'Module agregado'); //return redirect()->route('role.create')->with('mensaje', 'Role agregado');            
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('mensaje_rollback', 'ROLLBACK: Module no se pudo agregar '.$e->getMessage()); //return redirect()->route('role.create')->with('mensaje_rollback', 'ROLLBACK: Role no se pudo agregar');            
        }
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'module.destroy');

        $module = Module::where('id', $id)->firstOrFail();
        $module->delete();
        return redirect()->route('module.index')->with('mensaje', 'Module eliminado');
    }

    public function get_permisos_autogenerados($request, $module)
    {
        $permisos_autogenerados[] = array(
            "name"       => "List {term}",
            "slug"       => "{term}.index",
            "description" => "A user can list {term}"                
        );
        $permisos_autogenerados[] = array(
            "name"       => "Show {term}",
            "slug"       => "{term}.show",
            "description" => "A user can see {term}"                
        );
        $permisos_autogenerados[] = array(
            "name"       => "Create {term}",
            "slug"       => "{term}.create",
            "description" => "A user can create {term}"                
        );
        $permisos_autogenerados[] = array(
            "name"       => "Edit {term}",
            "slug"       => "{term}.edit",
            "description" => "A user can edit {term}"                
        );
        $permisos_autogenerados[] = array(
            "name"       => "Destroy {term}",
            "slug"       => "{term}.destroy",
            "description" => "A user can destroy {term}"                
        ); 
        
        foreach($permisos_autogenerados as $key=>$permisos){
            $permisos_autogenerados[$key]['name']       = str_replace("{term}", strtolower($request->name), $permisos['name']);
            $permisos_autogenerados[$key]['slug']       = str_replace("{term}", strtolower($request->name), $permisos['slug']);
            $permisos_autogenerados[$key]['description'] = str_replace("{term}", strtolower($request->name), $permisos['description']);
            $permisos_autogenerados[$key]['module_id']  = $module->id;
        }
        return $permisos_autogenerados;
    }
}
