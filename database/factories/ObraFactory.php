<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obra>
 */
class ObraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'imagen' => $this->faker->imageUrl(),
            'estado' => $this->faker->randomElement(['pendiente', 'aprobada', 'rechazada']),   
            'user_id' => User::factory(),
            'categoria' => $this->faker->randomElement([
                'igualdad sexos',
                'diversidad cultural',
                'integración personas con discapacidad intelectual',
                'comunidad LGTBI',
                'integración personas con discapacidad física'                      
        ])    

        ];
    }
}
