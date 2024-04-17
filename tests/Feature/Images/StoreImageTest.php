<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreImageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_stores_image(): void
    {
        Storage::fake('images_storage');

        $this->postJson(route('api.images.store'), [
            'name' => 'a great image',
            'image' => UploadedFile::fake()->image('avatar.jpg')
        ])->assertStatus(201);

        $this->assertDatabaseCount('images', 1);
        $image = Image::first();

        Storage::disk('images_storage')->assertExists($image->path);
    }
}
