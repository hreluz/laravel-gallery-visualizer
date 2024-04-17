<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Images\StoreImageRequest;
use App\Http\Resources\Image\ImageResource;
use App\Models\Image;
use Intervention\Image\ImageManager;


class ImageController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ImageResource::collection(Image::paginate(10));
    }

    /**
     * @param Image $image
     * @return ImageResource
     */
    public function show(Image $image)
    {
        return new ImageResource($image);
    }

    /**
     * @param StoreImageRequest $request
     * @return ImageResource
     */
    public function store(StoreImageRequest $request)
    {
        $image = Image::create([
            'name' => $request->name,
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalName();
            $filename = uniqid().$extension;
            $file->storeAs($image->id , $filename, 'images_storage');

            $image->update([
                'filename' => $filename
            ]);

            ImageManager::imagick()
                ->read($file)
                ->resize(100, 100)
                ->save($image->thumbnail_full_path);
        }

        return new ImageResource($image);
    }
}
