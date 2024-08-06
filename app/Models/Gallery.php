<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($gallery) {
            $baseSlug = Str::slug($gallery->title);
            $slug = $baseSlug;
            $count = 1;
            while (self::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $gallery->slug = $slug;
        });
    }
}
