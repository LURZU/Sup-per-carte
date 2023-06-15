<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Matiere;

class MatiereFactory extends Factory
{
    protected $model = Matiere::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000),
            'label' => $this->faker->sentence(3),
        ];
    }
}
