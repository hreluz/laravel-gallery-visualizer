<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

class ApiTestCase extends TestCase
{
    use RefreshDatabase;

    public function getPrefixRoute(): string
    {
        return 'api.';
    }

    public function getRoute(string $route, $param = null): string
    {
        return route($this->getPrefixRoute() . $route, $param);
    }

    /**
     * @param array $routes_with_methods
     * @return \Illuminate\Support\Collection
     */
    public function getRoutesStatusResponses(array $routes_with_methods): Collection
    {
        $status = [];

        foreach ($routes_with_methods as $type => $routes) {
            foreach ($routes as $route) {
                $response = match ($type) {
                    'post' => $this->postJson($route, []),
                    'delete' => $this->deleteJson($route),
                    default => $this->getJson($route),
                };
                $status[] = $response->getStatusCode();
            }
        }

        return collect($status);
    }
}
