<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\UserTrait;

class User extends Authenticatable
{
    use Notifiable, UserTrait;

    protected $table      = "users";
    protected $primaryKey = "id";
    public $timestamps    = true;
    
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    
    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /* RELACION DE MUCHOS A MUCHOS */
    //Un usuario puede tener muchos roles
    public function roles(){
        return $this->belongsToMany('App\Role')->withTimeStamps();
    }
}
