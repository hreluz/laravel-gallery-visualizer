<?php

namespace Tests\Feature\Api\v1\Images;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\v1\ApiV1TestCase;
use Tests\TestCase;

class DestroyImageTest extends ApiV1TestCase
{
    use RefreshDatabase;

    public function test_can_destroy_an_image_record(): void
    {
        Image::factory(2)->create();
        $image = Image::latest()->first();

        $this->deleteJson( $this->getRoute('images.destroy', $image->id))
            ->assertNoContent();

        $this->assertModelMissing($image);
    }
}
