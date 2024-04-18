<?php

namespace Tests\Feature\Api\v1;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Laravel\Sanctum\Sanctum;
use Tests\ApiTestCase;

class ApiV1TestCase extends ApiTestCase
{
    public function getPrefixRoute(): string
    {
        return parent::getPrefixRoute() . 'v1.';
    }

    public function actAs(UserContract $user = null)
    {
        Sanctum::actingAs($user ?? User::factory()->create());
    }
}
