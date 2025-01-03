<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Obra;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ObraUser>
 */
class ObraUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        // No se llama a esta factory ya que puede generar datos de ids 
        // duplicadas.
        return [
            'obra_id' => Obra::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'voto' => $this->faker->numberBetween(1, 5),
        ];
    }
}
