<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Support\Facades\Hash;
use Tests\ApiTestCase;

class UpdatePasswordControllerTest extends ApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->actAs();
    }

    public function test_it_can_update_password()
    {
        $previous_password = $this->user->password;
        $new_password = 'A complex password 123!';

        $this->putJson($this->getRoute('auth.update_password'), [
            'current_password' => 'password',
            'password' => $new_password,
            'password_confirmation' => $new_password
        ])->assertOk();

        $this->assertNotEquals($previous_password, $this->user->fresh()->password);
        $this->assertTrue(Hash::check($new_password, $this->user->fresh()->password));
    }

    public function test_it_cannot_update_password_if_correct_current_password_is_not_sent()
    {
        $this->putJson($this->getRoute('auth.update_password'), [
            'current_password' => 'not correct password',
        ])->assertForbidden();
    }
}
