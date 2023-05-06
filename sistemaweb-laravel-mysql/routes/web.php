<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Ruta por defecto
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {    
    $auth = Auth::user();        

    if(!empty($auth)){
        return view('home');        
    }else{
        return view('auth.login');
    }
});

//RUTAS DE LA APLICACION
    //Rutas de prueba
    Route::get("/pruebas/user", "PruebasController@user");
    Route::get("/pruebas/role", "PruebasController@role");
    Route::get('/testGate', function () {
        //$user = User::findOrFail(2);
        //return $user->roles;        

        //$user = User::findOrFail(2);
        //return $user->havePermission('role.list');
        
        Gate::authorize('haveaccess', 'role.index');
    });

    //Rutas
    Route::resources([
        'almacen/categoria' => 'CategoriaController',
        'almacen/articulo'  => 'ArticuloController',
        'ventas/cliente'    => 'ClienteController',
        //'ventas/venta'    => 'VentaController',
        'compras/proveedor' => 'ProveedorController',
        'compras/ingreso'   => 'IngresoController',        
        'acceso/user'       => 'UserController',
        'acceso/role'       => 'RoleController',
        'acceso/module'     => 'ModuleController'
    ]);
    
    //Rutas de usuarios
    Route::get("acceso/usuario/password/{usuario}/edit", "UserController@PasswordEdit")->name('user.passwordEdit');
    Route::put("acceso/usuario/password/{usuario}", "UserController@PasswordUpdate")->name('user.passwordUpdate');

    //Rutas de autenticación
    // Auth::routes();
    // Route::get('/home', 'HomeController@index')->name('home');

    //Rutas de autenticación, desactivamos las rutas register, reset, confirm de la autenticación
    Auth::routes([
        'register' => false,
        'reset'    => false,
        'confirm'  => false
    ]);
    Route::get('/home', 'HomeController@index')->name('home');
