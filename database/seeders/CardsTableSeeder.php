<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $faker= Faker::create();

        DB::table('card')->insert([
            [
                'matiere_id' => 1,
                'formation_id' => 1,
                'question' => $faker->title,
                'response' => $faker->jobTitle,
                'public' => true,
                'card_chapitre_id' => 1,
                'card_level_id' => 1,
                'card_semestre_id' => 1,
                'created_by' => 'John Doe',
                'validated_by' => 'John Doe',
                'user_id' => 3
            ], 
            [
                'matiere_id' => 1,
                'formation_id' => 1,
                'question' => $faker->title,
                'response' => $faker->jobTitle,
                'public' => true,
                'card_chapitre_id' => 1,
                'card_level_id' => 1,
                'card_semestre_id' => 1,
                'created_by' => 'John Doe',
                'validated_by' => 'John Doe',
                'user_id' => 3
            ],
            [
                'matiere_id' => 2,
                'formation_id' => 2,
                'question' => $faker->title,
                'response' => $faker->jobTitle,
                'public' => false,
                'card_chapitre_id' => 2,
                'card_level_id' => 2,
                'card_semestre_id' => 1,
                'created_by' => 'Tom',
                'validated_by' => 'John Doe',
                'user_id' => 2
            ],
            [
                'matiere_id' => 1,
                'formation_id' => 2,
                'question' => 'Quelles sont les outils test Lorem ipseum ?',
                'response' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Nulla euismod, nisl vitae aliquam ultricies, nunc nisl ultricies nunc, vitae aliquam nisl nisl vitae nisl. Donec euismod, nisl vitae aliquam ultricies, nunc nisl ultricies nunc, vitae aliquam nisl nisl vitae nisl.',
                'public' => false,
                'card_chapitre_id' => 2,
                'card_level_id' => 2,
                'card_semestre_id' => 1,
                'created_by' => 'Tom',
                'validated_by' => 'John Doe',
                'user_id' => 2
            ]
        ]);
    }
}
