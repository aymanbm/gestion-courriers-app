<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courrier>
 */
class CourrierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => fake()->numberBetween($int1=0,$int2=999999999),
            'date_reçu' => fake()->date(),
            'date_envoyer' => fake()->date(),
            'destinateur' => fake()->name(),
            'lieu_destinateur' => fake()->address(),
            'objet' => fake()->text(),
            'commentaire' => fake()->text(),
            'files' => fake()->text(),
            'courrier_statue' => "مرسلة",

        ];
    }
}
