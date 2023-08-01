<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\CardLevel;

class CardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test card in app.
     *
     * @return void
     */
    public function test_student_cant_see_formation_input_on_card_create_page(): void
    {
        $user = User::factory()->create();
        $user->assignRole('etudiant');

        Auth::login($user);

        $response = $this->get('/card/create');

        // Check that the 'Formation' input does not appear on the page
        $response->assertDontSee('formation_id');
    }

    public function test_prof_can_see_formation_input_on_card_create_page(): void
    {
        $user = User::factory()->create();
        $user->assignRole('enseignant');

        Auth::login($user);

        $response = $this->get('/card/create');

        // Check that the 'Formation' input does not appear on the page
        $response->assertSee('formation_id');
    }

    public function test_admin_can_see_formation_input_on_card_create_page(): void
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        Auth::login($user);

        $response = $this->get('/card/create');

        // Check that the 'Formation' input does not appear on the page
        $response->assertSee('formation_id');
    }


    public function test_student_can_create_card_and_usable_in_database(): void
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        $user->assignRole('etudiant');
        Auth::login($user);
    
        $cardData = Card::factory()->make()->toArray();
        unset($cardData['user_id']);
    
        // Note that you're now POSTing to '/card/create', not '/card'
        $response = $this->post('/card/create', [
            'question' => $cardData['question'],
            'response' => $cardData['response'],
            'matiere_id' => $cardData['matiere_id'],
            //formation_id redifine when he passed in the controller
            'formation_id' => 1,
            //Test if the parameters public is set to false when he passed the controller when he have student role
            'public' => 1,
            'card_chapitre_id' => 1,
            'card_level_id' => 1,
            'card_semestre_id' => 1,
            'created_by' => $user->name,
            'validated_by' =>'admin',
            'user_id' => $user->id,
        ]);
    
        $response->assertRedirect(); 
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');

        // Assert that the card was created in the database
        $this->assertDatabaseHas('card', [
            'question' => $cardData['question'],
            'response' => $cardData['response'],
            //redifine by the formation_id of the user
            'formation_id' => $user->formation_id,
            'matiere_id' => $cardData['matiere_id'],
            'public' => 0,
            'card_chapitre_id' => 1,
            'card_level_id' => 1,
            'card_semestre_id' => 1,
            'created_by' => $user->name,
            'validated_by' => null,
            'user_id' => $user->id,
        ]);
    }

    public function test_card_creation_fails_with_invalid_data(): void
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        $user->assignRole('etudiant');
        Auth::login($user);
    

        unset($cardData['user_id']);
        unset($cardData['question']);  // Enlève une donnée essentielle pour que le test échoue
    
        $response = $this->post('/card/create', $cardData);
    
        // Vérifie que le système a renvoyé une erreur
        $response->assertSessionHasErrors();
    }


    
    

}
