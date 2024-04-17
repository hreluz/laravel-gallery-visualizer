<?php

namespace Tests\Feature\Api\v1\Images;

trait ImageStructureTrait
{
    protected function imageStructure(): array
    {
        return  [
            'id',
            'name',
            'watched',
            'url'
        ];
    }
}
