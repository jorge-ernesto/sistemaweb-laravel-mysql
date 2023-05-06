<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App; //Recuperando modelos, App es el namespace
use Illuminate\Support\Facades\DB; //Recuperando resultados

class PruebasController extends Controller
{
    public function user(Request $request)
    {
        $users  = App\User::get();
        $users2 = DB::select('select * from users');
        $users3 = DB::table('users')
                        ->get();

        foreach($users as $key=>$user){
            echo "<h1>{$user->name}</h1>";

            foreach($user->roles as $key=>$role){
                echo "<h3>{$role->name}       </h3>";            
                echo "<p> {$role->description}</p>";
                echo "<p> {$role->created_at} </p>";
                echo "<p> {$role->updated_at} </p>";
            }
            echo "<hr>";
        }
    }   
    
    public function role(Request $request)
    {        
        //Role
        $user = App\User::find(1);
        foreach($user->roles as $key=>$role){
            echo $role->name;
        }
        echo "<hr>";
        
        //Otra forma
        $roles = App\User::find(1)->roles()->get();     
        echo $roles;       
    }   
}
