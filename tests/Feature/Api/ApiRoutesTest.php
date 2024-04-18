<?php

namespace Tests\Feature\Api;

use Tests\ApiTestCase;

class ApiRoutesTest extends ApiTestCase
{
    public function test_routes_does_not_require_authentication()
    {
        $routes_with_methods = [
            'post' => [
                $this->getRoute('auth.register'),
                $this->getRoute('auth.login')
            ]
        ];

        $this->assertEquals(false,
            $this->getRoutesStatusResponses($routes_with_methods)->some(fn($v) => $v == 401)
        );
    }
}
