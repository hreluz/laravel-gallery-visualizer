<?php

namespace Tests\Feature\Api\v1;

use Tests\ApiTestCase;

class ApiV1TestCase extends ApiTestCase
{
    public function getPrefixRoute(): string
    {
        return parent::getPrefixRoute() . 'v1.';
    }
}
