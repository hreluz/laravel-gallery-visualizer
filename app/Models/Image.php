<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path'];

    protected $casts = [
        'watched' => 'boolean'
    ];

    public function getUrlAttribute()
    {
        return Storage::disk('images_storage')->url($this->path);
    }
}
