<?php

namespace Tests\Feature\Api\v1\Images;

use App\Models\Image;
use Tests\Feature\Api\v1\ApiV1TestCase;

class DestroyImageTest extends ApiV1TestCase
{
    public function test_can_destroy_an_image_record(): void
    {
        Image::factory(2)->create();
        $image = Image::latest()->first();

        $this->deleteJson( $this->getRoute('images.destroy', $image->id))
            ->assertNoContent();

        $this->assertModelMissing($image);
    }
}
