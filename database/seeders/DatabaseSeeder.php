<?php

namespace Database\Seeders;

use App\Models\Ayudante;
use App\Models\Config;
use App\Models\Producto;
use App\Models\Rol;
use App\Models\Ruta;
use App\Models\Tienda;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        $permisos = 'god';


        Rol::factory()->create([
            "nombre"=>"super-admin",
            "permisos"=>$permisos,
        ]);
        
        User::factory()->create([
            "name"=>"admin",
            "permisos"=>$permisos,
            "email"=>"admin",
        ]);

        Producto::create(["nombre"=>"Bolsa","tipo"=>"1","cantidad"=>"0"]);
        Producto::create(["nombre"=>"Bolsa de hielo 5kg","tipo"=>"2","cantidad"=>"0"]);
        Producto::create(["nombre"=>"Costal","tipo"=>"1","cantidad"=>"0"]);
        Producto::create(["nombre"=>"Bolsa de hielo 20kg","tipo"=>"2","cantidad"=>"0"]);

        Producto::create(["nombre"=>"Preforma","tipo"=>"1","cantidad"=>"0"]);
        Producto::create(["nombre"=>"Garrafón plástico","tipo"=>"2","cantidad"=>"0"]);
        Producto::create(["nombre"=>"Agua garrafón","tipo"=>"2","cantidad"=>"0"]);

        Tienda::create(["nombre"=>"Oxxo","direccion"=>"Ejemplo"]);

        Ruta::create(["nombre"=>"Ruta #1"]);

        Ayudante::create([
            "nombre"=>"test",
            "apellido_paterno"=>"test",
            "apellido_materno"=>"test",
            "alias"=>"test",
        ]);

        Config::create([
            "temperatura_alerta"=>1,
            "temperatura_correo"=>"test@test.com"
        ]);
    }
}
