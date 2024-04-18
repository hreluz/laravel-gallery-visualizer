<?php

namespace Tests\Feature\Api\Auth;

trait AuthUserStructureTrait
{
    protected function authUserStructure(): array
    {
        return  [
            'id',
            'name',
            'email',
            'accessToken'
        ];
    }
}
