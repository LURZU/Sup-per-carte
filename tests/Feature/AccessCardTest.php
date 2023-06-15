<?php 


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccessCardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_if_guest_cant_access_to_card_list(): void
    {
        $response = $this->get('/card');
        //Because we are not logged in, we should be redirected to the login page
        $response->assertStatus(302);
    }

    public function test_if_student_cant_access_to_all_card_list(): void
    {
        // create a user with the 'student' role
        
        // (I assume that you have a method to assign a role to the user)
        $user = User::factory()->create()->assignRole('etudiant');

        // login as the created user
        Auth::login($user);

        $response = $this->get('/card');

        //Because we are logged in as a student, we should be redirected to /card/private
        $response->assertRedirect('/card/private');
    }

    public function test_if_enseignant_cant_access_to_all_card_list(): void
    {
        // create a user with the 'student' role
        
        // (I assume that you have a method to assign a role to the user)
        $user = User::factory()->create()->assignRole('enseignant');

        // login as the created user
        Auth::login($user);

        $response = $this->get('/card');

        //Because we are logged in as a student, we should be redirected to /card/private
        $response->assertRedirect('/card/list');
    }


}
