<?php

namespace Tests\Feature\Api\v1\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\v1\ApiV1TestCase;

class IndexImagesTest extends ApiV1TestCase
{
    use RefreshDatabase, ImageStructureTrait;

    public function test_index_images()
    {
        Image::factory(15)->create();

        $this->getJson($this->getRoute('images.index'))
            ->assertOk()
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->imageStructure()
                ]
            ]);

        $this->assertDatabaseCount('images', 15);
    }
}
