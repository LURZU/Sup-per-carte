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
            'matiere_id' => $this->faker->numberBetween(1, 10),  
            'formation_id' => $this->faker->numberBetween(1, 10),  
            'public' => $this->faker->boolean,
            'card_chapitre_id' => $this->faker->numberBetween(1, 10),  
            'card_level_id' => $this->faker->numberBetween(1, 10), 
            'card_semestre_id' => $this->faker->numberBetween(1, 10), 
            'created_by' => $this->faker->name,
            'validated_by' => $this->faker->name,
            'user_id' => $this->faker->numberBetween(1, 10), 
            'question_img_url' => $this->faker->imageUrl(),  
            'response_img_url' => $this->faker->imageUrl(),  
        ];
    }
}
