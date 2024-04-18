<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Tests\ApiTestCase;

class LoginControllerTest extends ApiTestCase
{
    use AuthUserStructureTrait;

    public function test_user_can_login(): void
    {
        $user = User::factory()->create();

        $this->postJson($this->getRoute('auth.login'), [
            'email' => $user->email,
            'password' => 'password'
        ])->assertOk()
            ->assertJsonStructure([
                'data' => $this->authUserStructure()
            ])
            ->assertJsonFragment([
                'email' => $user->email
            ]);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create();
        $this->postJson($this->getRoute('auth.login'), [
            'email' => $user->email,
            'password' => 'password incorrect'
        ])->assertJsonValidationErrors([
            'email' => ['The provided credentials are incorrect.']
        ])->assertUnprocessable();
    }
}
