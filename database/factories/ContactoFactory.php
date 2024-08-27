<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacto>
 */
class ContactoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->word(),
            'apellido_paterno'=>$this->faker->word(),
            'apellido_materno'=>$this->faker->word(),
            'correo_electronico'=>$this->faker->word(),
            'calle'=>$this->faker->word(),
            'numero'=>$this->faker->word(),
            'colonia'=>$this->faker->word(),
            'codigo_postal'=>$this->faker->word(),
            'ciudad'=>$this->faker->word(),
            'estado'=>$this->faker->word(),
            'pais'=>$this->faker->word(),
            'telefono'=>$this->faker->word(),
        ];
    }
}
