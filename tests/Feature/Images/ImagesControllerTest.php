<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImagesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_get_images()
    {
        Image::factory(10)->create();

        $this->getJson('/api/images')
            ->assertOk()
            ->assertJsonCount(10);

        $this->assertDatabaseCount('images', 10);
    }
}
