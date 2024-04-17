<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'filename'];

    protected $casts = [
        'watched' => 'boolean'
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('images_storage')->url($this->id . '/' . $this->filename);
    }

    public function getImageFullPathAttribute()
    {
        return Storage::disk('images_storage')->path($this->id . '/'. $this->filename);
    }

    public function getThumbnailImageFullPathAttribute()
    {
        return Storage::disk('images_storage')->path($this->id . '/thumbnail-'. $this->filename);
    }
}
