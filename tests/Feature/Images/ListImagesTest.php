<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListImagesTest extends TestCase
{
    use RefreshDatabase, ImageStructureTrait;

    /**
     * A basic feature test example.
     */
    public function test_get_images()
    {
        Image::factory(10)->create();

        $this->getJson(route('api.images.index'))
            ->assertOk()
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->imageStructure()
                ]
            ]);

        $this->assertDatabaseCount('images', 10);
    }
}
