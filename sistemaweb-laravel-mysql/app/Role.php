<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table      = "roles";
    protected $primaryKey = "id";
    public $timestamps    = true;
    
    protected $fillable = [
        'name', 
        'slug', 
        'description',
        'full-access'
    ];

    /* RELACION DE MUCHOS A MUCHOS */
    //Un rol puede tener muchos usuarios
    public function users(){
        return $this->belongsToMany('App\User');
    }

    /* RELACION DE MUCHOS A MUCHOS */
    //Un rol puede tener muchos permisos
    public function permissions(){
        return $this->belongsToMany('App\Permission')->withTimeStamps();
    }
}
