<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table      = "categoria";   //Nombre de la Base de Datos
    protected $primaryKey = "idcategoria"; //Primary Key de la Base de Datos
    public $timestamps    = false;         //Guardar o no los campos timestamps: created_at y updated_at, como referencia podemos ver dichos campos en la tabla users

    //Estos son los campos que van a ser rellenables de la base de datos, que vamos asignar al modelo
    protected $fillable = [
        "nombre",
        "descripcion",
        "condicion"
    ];

    //Estos campos guarded, son campos que no vamos asignar al modelo
    protected $guarded = [
        
    ];
}
