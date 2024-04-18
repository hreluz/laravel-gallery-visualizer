<?php

namespace Tests\Feature\Api\Auth;

use Tests\ApiTestCase;

class ProfileControllerTest extends ApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->actAs();
    }

    public function test_it_shows_user_info()
    {
        $this->getJson($this->getRoute('auth.show'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email'
                ]
            ])->assertJson([
                'data' => [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ]
            ]);
    }

    public function test_it_can_update_name()
    {
        $this->putJson($this->getRoute('auth.update'), [
            'name' => 'Bruce',
            'email' => $this->user->email,
        ])->assertOk();

        $this->assertDatabaseHas('users', [
            'name' => 'Bruce',
            'email' => $this->user->email,
        ]);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_it_can_update_email()
    {
        $this->putJson($this->getRoute('auth.update'), [
            'name'  => $this->user->name,
            'email' => 'batman@gmail.com'
        ])->assertOk();

        $this->assertDatabaseHas('users', [
            'email' => 'batman@gmail.com'
        ]);

        $this->assertDatabaseCount('users', 1);
    }
}
