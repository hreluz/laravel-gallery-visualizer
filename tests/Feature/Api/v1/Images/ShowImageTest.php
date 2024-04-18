<?php

namespace Tests\Feature\Api\v1\Images;

use App\Models\Image;
use Tests\Feature\Api\v1\ApiV1TestCase;

class ShowImageTest extends ApiV1TestCase
{
    use ImageStructureTrait;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_shows_image(): void
    {
        $image = Image::factory()->create([
            'name' => 'image-1',
            'filename' => 'image-1.jpg',
            'watched' => true
        ]);

        $this->getJson($this->getRoute('images.show', $image->id))
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
        $this->getJson($this->getRoute('images.show', 123456))
            ->assertStatus(404);
    }
}
