<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Semestre;

class SemestreFactory extends Factory
{
    protected $model = Semestre::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000),
            'label' => $this->faker->sentence(3),
        ];
    }
}

