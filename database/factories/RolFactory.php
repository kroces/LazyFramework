<?php

namespace Database\Factories;

// use App\Tools\Router;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        // $data = Router::generarRoutasFormulario();
        $data = [];

        $permisos = [];

        foreach ($data as $name => $cat){
            foreach ($cat as $subcatname=>$subcat){
                foreach ($subcat as $key=>$permiso){
                    $permiso[] = [
                        "switch"=>$this->faker->boolean()?"true":"false",
                        "url" => $permiso['url']
                    ];
                }
            }
        }

        return [
            "permisos"=>json_encode($permisos),
            "nombre"=>$this->faker->words(2, true)
        ];
    }
}
