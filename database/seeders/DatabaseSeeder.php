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
    }
}
