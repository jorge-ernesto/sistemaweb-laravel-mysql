<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App; //Recuperando modelos, App es el namespace
use Illuminate\Support\Facades\DB; //Recuperando resultados
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class IngresoController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {      
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'ingreso.index');
        
        if($request){
            $searchText = $request->searchText;            
            $dataIngreso  = DB::table('ingreso as i')                                
                                ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                                ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')                                
                                ->select('i.idingreso', 'p.idpersona as idproveedor', 'p.nombre as proveedor', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.fecha_hora', 'i.impuesto', 'i.estado', DB::raw('SUM(di.cantidad * di.precio_compra) as total'))
                                ->where('i.num_comprobante', 'LIKE', '%'.$searchText.'%')                                                            
                                ->groupBy('i.idingreso')
                                ->orderBy('i.idingreso', 'DESC')                                
                                ->paginate(10);
            return view('compras.ingreso.index', compact('dataIngreso', 'searchText'));                                
        }
    }
    
    public function create()
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'ingreso.create');

        $dataPersona = DB::table('persona')
                            ->where('tipo_persona', '=', 'Proveedor')
                            ->get();
        $dataArticulo = DB::table('articulo as a')
                            ->select(DB::raw('a.idarticulo, CONCAT(a.codigo," - ",a.nombre) as articulo'))
                            ->where('a.estado', '=', 'Activo')
                            ->get();
        return view('compras.ingreso.create', compact('dataPersona', 'dataArticulo'));
    }
    
    public function store(Request $request)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'ingreso.create');

        /* Obtenemos todo el request */
        // return $request->all();

        /* Validar request ingreso, detalle */
        $request->validate([
            "idproveedor"       => "required",
            "tipo_comprobante"  => "required|max:20",
            "serie_comprobante" => "required|max:15",
            "num_comprobante"   => "required|max:15",
            "impuesto"          => "required|numeric|max:99",

            "idarticulo"    => "required",
            "cantidad"      => "required",
            "precio_compra" => "required",
            "precio_venta"  => "required"
        ]);

        try{
            DB::beginTransaction();            
            
            /* Guardamos ingreso */
            $ingreso                    = new App\Ingreso;
            $ingreso->idproveedor       = $request->idproveedor;
            $ingreso->tipo_comprobante  = $request->tipo_comprobante;
            $ingreso->serie_comprobante = $request->serie_comprobante;
            $ingreso->num_comprobante   = $request->num_comprobante;
            $date                       = Carbon::now('America/Lima');
            $ingreso->fecha_hora        = $date->toDateTimeString();            
            $ingreso->impuesto          = 18;
            $ingreso->estado            = "Aceptado";
            $ingreso->save();
            /* Actualizamos num_comprobante */
            DB::table('ingreso')
                ->where('idingreso', '=', $ingreso->idingreso)
                ->update(['num_comprobante' => $ingreso->idingreso]);

            /* Guardamos detalle */
            $idingreso           = $ingreso->idingreso;
            $idarticulo_array    = $request->idarticulo;
            $cantidad_array      = $request->cantidad;
            $precio_compra_array = $request->precio_compra;
            $precio_venta_array  = $request->precio_venta;
                        
            $cont = 0;
            while($cont < count($idarticulo_array)){
                $detalle                = new App\DetalleIngreso;
                $detalle->idingreso     = $idingreso;
                $detalle->idarticulo    = $idarticulo_array[$cont];
                $detalle->cantidad      = $cantidad_array[$cont];
                $detalle->precio_compra = $precio_compra_array[$cont];
                $detalle->precio_venta  = $precio_venta_array[$cont];              
                $detalle->save();
                $cont++;
            }

            DB::commit();
            return back()->with('mensaje', 'Ingreso agregado');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('mensaje_rollback', 'ROLLBACK: Ingreso no se pudo agregar');
        }                             
    }

    public function show($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'ingreso.show');

        $dataPersona = DB::table('persona')
                            ->where('tipo_persona', '=', 'Proveedor')
                            ->get();
        $dataIngreso = DB::table('ingreso as i')
                            ->join('persona as p', 'i.idproveedor', '=', 'p.idpersona')
                            ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso')
                            ->select('i.idingreso', 'p.idpersona as idproveedor', 'p.nombre as proveedor', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.fecha_hora', 'i.impuesto', 'i.estado', DB::raw('SUM(di.cantidad * di.precio_compra) as total'))
                            ->where('i.idingreso', '=', $id)                                                            
                            ->first();
        $dataDetalle = DB::table('detalle_ingreso as di')
                            ->join('articulo as a', 'di.idarticulo', '=', 'a.idarticulo')
                            ->select(DB::raw('a.idarticulo, CONCAT(a.codigo," - ",a.nombre) as articulo'), 'di.cantidad', 'di.precio_compra', 'di.precio_venta', DB::raw('di.cantidad * di.precio_compra as total'))
                            ->where('di.idingreso', '=', $id)
                            ->get();
        //dd($dataDetalle);
        return view('compras.ingreso.show', compact('dataPersona', 'dataIngreso', 'dataDetalle'));
    }

    public function edit($id)
    {        
    }

    public function update(Request $request, $id)
    {        
    }

    public function destroy($id)
    {
        /* Gate de acceso */
        Gate::authorize('haveaccess', 'ingreso.destroy');

        /* Cambiar estado de ingreso */
        $ingreso = App\Ingreso::findOrFail($id);
        $ingreso->estado = "Cancelado";
        $ingreso->update();
        return back()->with('mensaje_eliminado', 'Ingreso eliminado'); 
    }
}
