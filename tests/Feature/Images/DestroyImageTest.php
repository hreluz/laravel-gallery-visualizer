<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyImageTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_destroy_an_image_record(): void
    {
        Image::factory(2)->create();
        $image = Image::latest()->first();

        $this->deleteJson(route('api.images.destroy', $image->id))
            ->assertNoContent();

        $this->assertModelMissing($image);
    }
}
