<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TacheModel>
 */
class TachesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Nom' => fake()->words(6),
            'Description' => fake()->words(20),
            'Date_Echeance' => fake()->date('Y-m-d', 'after_now'),
            'Date_Creation' => fake()->date('Y-m-d', 'now'),
            'Priorite' => fake()->randomElement([1, 2, 3, 4]),
            'Statut' => fake()->randomElement([1, 2])
        ];
    }
}
