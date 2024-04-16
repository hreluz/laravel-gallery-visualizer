<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ImageResource::collection(Image::all());
    }

    /**
     * @param Image $image
     * @return ImageResource
     */
    public function show(Image $image)
    {
        return new ImageResource($image);
    }
}
