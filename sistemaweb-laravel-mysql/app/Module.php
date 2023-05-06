<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table      = "modules";
    protected $primaryKey = "id";
    public $timestamps    = true;
    
    protected $fillable = [
        'name'
    ];

    /* RELACION DE UNO A MUCHOS */
    //Un modulo puede tener muchos permisos
    public function permissions(){
        return $this->hasMany("App\Permission");
    }
}
