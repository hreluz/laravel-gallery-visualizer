<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Tests\ApiTestCase;

class RegisterControllerTest extends ApiTestCase
{
    use AuthUserStructureTrait;

    public function test_it_can_register_user()
    {
        $this->postJson(route('api.auth.register'), [
            'name' => 'Bruce',
            'email' => 'batman@gmail.com',
            'password' => 'a complex P#ssword2',
            'password_confirmation' => 'a complex P#ssword2'
        ])->assertJsonStructure([
            'data' => $this->authUserStructure()
        ])->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => 'Bruce',
            'email' => 'batman@gmail.com',
        ]);
    }

    public function test_it_only_allow_unique_emails_when_registers()
    {
        $user = User::factory()->create([
            'email' => 'batman@gmail.com'
        ]);

        $this->postJson(route('api.auth.register'), [
            'email' => $user->email,
        ])->assertJsonValidationErrors('email')->assertUnprocessable();
    }
}
