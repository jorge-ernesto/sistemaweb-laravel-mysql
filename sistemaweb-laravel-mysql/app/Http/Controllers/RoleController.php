<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role; //Recuperando modelos, App es el namespace
use App\Module; //Recuperando modelos, App es el namespace
use App\Permission; //Recuperando modelos, App es el namespace
use Illuminate\Support\Facades\DB; //Recuperando resultados
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'role.index');
        
        if($request){
            $searchText = $request->searchText;
            $roles = Role::where('name', 'LIKE', '%'.$searchText.'%')
                            ->orderBy('id', 'ASC')
                            ->paginate('10');
            return view('acceso.role.index', compact('roles', 'searchText'));
        }
    }

    public function create()
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'role.create');
        
        $modulos = Module::orderBy('name', 'ASC')->get();
        $permisos = Permission::get();
        return view('acceso.role.create', compact('modulos', 'permisos'));
    }

    public function store(Request $request)
    {       
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'role.create');
        
        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request */
        $request->validate([
            "name"        => "required|max:50|unique:roles,name",
            "slug"        => "required|max:50|unique:roles,slug",
            "full-access" => "required|in:yes,no"
        ]);
                
        try{
            DB::beginTransaction();            
            
            /* Guardamos role */
            $role = Role::create($request->all());      
            
            /* Guardamos permission_role */          
            if(!empty($role) && is_object($role) && isset($role)){                
                $role->permissions()->sync( $request->get('permisos') );
            }                                  
             
            DB::commit();
            return back()->with('mensaje', 'Role agregado'); //return redirect()->route('role.create')->with('mensaje', 'Role agregado');            
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('mensaje_rollback', 'ROLLBACK: Role no se pudo agregar '.$e->getMessage()); //return redirect()->route('role.create')->with('mensaje_rollback', 'ROLLBACK: Role no se pudo agregar');            
        }
    }

    /*
     * Es lo mismo que edit, pero en lugar de retornar a acceso.role.edit retornamos a la vista acceso.role.show
     * La vista no la cree ya que era una perdido de tiempo, pero esta en el video "10. Métodos view y destroy"
     * https://youtu.be/VdoOfQfZRnI
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'role.edit');

        /* Obtenemos todos los modulos existentes */
        $modulos = Module::orderBy('name', 'ASC')->get();

        /* Obtenemos todos los permisos existentes */
        $permisos = Permission::get();

        /* Obtenemos los datos del rol a editar */
        $role = Role::findOrFail($id);
        
        /* Obtenemos los permisos del rol y lo convertimos en un array */
        $permisos_ = array();
        foreach ($role->permissions as $key=>$permiso) {
            $permisos_[] = $permiso->id;
        }    

        /* Verificamos los datos */
        // echo "<pre>";
        // echo "<script>console.log('" . json_encode($permisos) . "')</script>";
        // echo "<script>console.log('" . json_encode($role) . "')</script>";
        // echo "<script>console.log('" . json_encode($permisos_) . "')</script>";
        // echo "<pre>";
        // die();

        return view('acceso.role.edit', compact('modulos', 'permisos', 'role', 'permisos_'));
    }

    public function update(Request $request, $id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'role.edit');

        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request */
        $request->validate([
            "name"        => "required|max:50|unique:roles,name,$id",
            "slug"        => "required|max:50|unique:roles,slug,$id",
            "full-access" => "required|in:yes,no"
        ]);

        try{
            DB::beginTransaction();            
            
            /* Quitamos los campos que no queremos actualizar */
            $params_array = $request->all();
            unset($params_array['_token']);
            unset($params_array['_method']);
            unset($params_array['permisos']);

            /* Guardamos role */
            $role = Role::where('id', $id)->firstOrFail();
            $role->update($params_array);
            
            /* Guardamos permission_role */          
            if(!empty($role) && is_object($role) && isset($role)){
                $role->permissions()->sync( $request->get('permisos') );
            }                                  
             
            DB::commit();
            return back()->with('mensaje', 'Role actualizado'); //return redirect()->route('role.edit', $id)->with('mensaje', 'Role actualizado');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('mensaje_rollback', 'ROLLBACK: Role no se pudo actualizar '.$e->getMessage()); //return redirect()->route('role.edit', $id)->with('mensaje_rollback', 'ROLLBACK: Role no se pudo actualizar '.$e->getMessage());
        }
    }

    public function destroy($id)
    {     
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'role.destroy');
        
        $role = Role::where('id', $id)->firstOrFail();
        $role->delete();
        return redirect()->route('role.index')->with('mensaje', 'Role eliminado');
    }
}
