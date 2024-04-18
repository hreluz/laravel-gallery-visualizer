<?php

namespace Tests\Feature\Api\v1\Images;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\Api\v1\ApiV1TestCase;

class StoreImageTest extends ApiV1TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->actAs();
    }

    public function test_stores_image(): void
    {
        Storage::fake('images_storage');

        $this->postJson($this->getRoute('images.store'), [
            'name' => 'a great image',
            'image' => UploadedFile::fake()->image('avatar.jpg')->size(config('image.image_size_max_kb'))
        ])->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where('data.name', 'a great image')
                    ->whereNot('data.watched', true)
            );

        $this->assertDatabaseCount('images', 1);
        $image = Image::first();

        Storage::disk('images_storage')->assertExists($image->path);
    }

    public function test_it_store_images_size_1mb(): void
    {
        Storage::fake('images_storage');

        $this->postJson($this->getRoute('images.store'), [
            'name' => 'a great image',
            'image' => UploadedFile::fake()
                ->image('avatar.jpg')
                ->size(config('image.kb_unit') * 1)
        ])->assertStatus(201);
    }

    public function test_it_does_not_store_images_bigger_than_5mb(): void
    {
        Storage::fake('images_storage');

        $this->postJson($this->getRoute('images.store'), [
            'name' => 'a great image',
            'image' => UploadedFile::fake()
                ->image('avatar.jpg')
                ->size(config('image.kb_unit') * config('image.size_unit') + 1)
        ])->assertStatus(422);
    }
}
