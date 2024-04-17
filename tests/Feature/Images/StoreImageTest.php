<?php

namespace Tests\Feature\Images;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreImageTest extends TestCase
{
    public function test_stores_image(): void
    {
        Storage::fake('images_storage');

        $this->postJson(route('api.images.store'), [
            'name' => 'a great image',
            'image' => UploadedFile::fake()->image('avatar.jpg')->size(config('image.image_size_max_kb'))
        ])->assertStatus(201);

        $this->assertDatabaseCount('images', 1);
        $image = Image::first();

        Storage::disk('images_storage')->assertExists($image->path);
    }

    public function test_it_store_images_size_1mb(): void
    {
        Storage::fake('images_storage');

        $this->postJson(route('api.images.store'), [
            'name' => 'a great image',
            'image' => UploadedFile::fake()
                ->image('avatar.jpg')
                ->size(config('image.kb_unit') * 1)
        ])->assertStatus(201);
    }

    public function test_it_does_not_store_images_bigger_than_5mb(): void
    {
        Storage::fake('images_storage');

        $this->postJson(route('api.images.store'), [
            'name' => 'a great image',
            'image' => UploadedFile::fake()
                ->image('avatar.jpg')
                ->size(config('image.kb_unit') * config('image.size_unit') + 1)
        ])->assertStatus(422);
    }
}
