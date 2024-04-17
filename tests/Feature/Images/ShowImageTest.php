<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowImageTest extends TestCase
{
    use RefreshDatabase, ImageStructureTrait;

    public function test_it_shows_image(): void
    {
        $image = Image::factory()->create([
            'name' => 'image-1',
            'filename' => 'image-1.jpg',
            'watched' => true
        ]);

        $this->getJson(route('api.images.show', $image->id))
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->imageStructure()
            ])
            ->assertJsonFragment([
                'name' => 'image-1',
                'url' => $image->url,
                'watched' => true
            ]);

        $this->assertDatabaseCount('images', 1);
    }

    public function test_it_shows_404_error(): void
    {
        $this->getJson(route('api.images.show', 123456))
            ->assertStatus(404);
    }
}
