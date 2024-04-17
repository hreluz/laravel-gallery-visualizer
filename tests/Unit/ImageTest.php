<?php

namespace Tests\Unit;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_image_full_path()
    {
        $image = new Image();
        $image->id = 1;
        $image->name = 'any file name';
        $image->filename = 'filename.jpg';

        $this->assertEquals(
            $image->image_full_path,
            Storage::disk('images_storage')->path($image->id . '/'. $image->filename)
        );
    }

    /**
     * A basic unit test example.
     */
    public function test_thumbnail_image_full_path()
    {
        $image = new Image();
        $image->id = 1;
        $image->name = 'any file name';
        $image->filename = 'filename.jpg';

        $this->assertEquals(
            $image->thumbnail_image_full_path,
            Storage::disk('images_storage')->path($image->id . '/thumbnail-'. $image->filename)
        );
    }

    public function test_generated_url()
    {
        $image = new Image();
        $image->id = 1;
        $image->name = 'any file name';
        $image->filename = 'filename.jpg';

        $this->assertEquals(
            $image->url,
            env('APP_URL').'/storage/images/1/filename.jpg'
        );

    }
}
