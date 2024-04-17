<?php

namespace Tests\Feature\Api\v1;

use Tests\ApiTestCase;

class ApiV1TestCase extends ApiTestCase
{
    public const API_ROUTE = 'api.v1.';

    public function getRoute(string $route, $param = null): string
    {
        return route(self::API_ROUTE . $route, $param);
    }
}
