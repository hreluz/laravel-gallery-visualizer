<?php

namespace Tests\Feature\Api\v1;

class ApiV1RoutesTest extends ApiV1TestCase
{
    public function test_api_v1_routes_that_require_authentication()
    {
        $routes_with_methods = [
            'post' => [$this->getRoute('images.store')],
            'delete' => [$this->getRoute('images.destroy', 1)]
        ];

        $this->assertEquals(false,
            $this->getRoutesStatusResponses($routes_with_methods)->some(fn($v) => $v != 401)
        );
    }
    public function test_routes_does_not_require_authentication()
    {
        $routes_with_methods = [
            'get' => [$this->getRoute('images.index'), $this->getRoute('images.show', 1)]
        ];

        $this->assertEquals(false,
            $this->getRoutesStatusResponses($routes_with_methods)->some(fn($v) => $v == 401)
        );
    }
}
