<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Responsable>
 */
class ResponsableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nombres' => $this->faker->firstName(),
            'Apellidos' => $this->faker->lastName(),
            'Correo' => $this->faker->unique()->safeEmail(),
            'Estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}
