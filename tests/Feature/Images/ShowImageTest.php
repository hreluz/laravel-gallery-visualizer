<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowImageTest extends TestCase
{
    use RefreshDatabase, ImageStructureTrait;

    /**
     * A basic feature test example.
     */
    public function test_it_shows_image(): void
    {
        $image = Image::factory()->create([
            'name' => 'image-1',
            'path' => 'https://somepath.com',
            'watched' => true
        ]);

        $this->getJson(route('api.images.show', $image->id))
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->imageStructure()
            ])
            ->assertJsonFragment([
                'name' => 'image-1',
                'path' => 'https://somepath.com',
                'watched' => true
            ]);

        $this->assertDatabaseCount('images', 1);
    }
}
