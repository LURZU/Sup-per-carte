<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'response' => $this->faker->sentence,
            'matiere_id' => $this->faker->numberBetween(1, 10),  // Change range as needed
            'formation_id' => $this->faker->numberBetween(1, 10),  // Change range as needed
            'public' => $this->faker->boolean,
            'card_chapitre_id' => $this->faker->numberBetween(1, 10),  // Change range as needed
            'card_level_id' => $this->faker->numberBetween(1, 10),  // Change range as needed
            'card_semestre_id' => $this->faker->numberBetween(1, 10),  // Change range as needed
            'created_by' => $this->faker->name,
            'validated_by' => $this->faker->name,
            'user_id' => $this->faker->numberBetween(1, 10),  // Change range as needed
            'question_img_url' => $this->faker->imageUrl(),  // This generates a random URL, not an actual image file
            'response_img_url' => $this->faker->imageUrl(),  // This generates a random URL, not an actual image file
        ];
    }
}
