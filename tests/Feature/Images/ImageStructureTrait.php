<?php

namespace Tests\Feature\Images;

trait ImageStructureTrait
{
    protected function imageStructure(): array
    {
        return  [
            'id',
            'name',
            'watched',
            'path'
        ];
    }
}
