<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permisos',
        'cliente_proveedor_id',
        'almacen_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*public function almacenes(){
        return Almacen::get();
    }
    public function almacen(){
        return $this->hasOne(Almacen::class, "id", "almacen_id");
    }*/

    public function canDelete(){
        return true;
    }

    public function json(){
        if(!isset($this->permiso_json))
            $this->permiso_json = json_decode($this->permisos);
        return $this->permiso_json;
    }

    public function permiso($url){
        if($this->permisos == "god") return true;
        $data = $this->json();
        if($data && sizeof($data) > 0)
            foreach($data as $element){
                if($url == $element->url){
                    return $element->switch;
                }
            }
        return false;
    }

    public function getValue($val){
        $data = $this->toArray();
        return $data[$val];
    }

    public function roles(){
        return Rol::get();
    }

    // public static function carrito(){
    //     return new \App\Tools\Carrito();
    // }
}
