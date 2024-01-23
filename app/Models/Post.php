<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'image', 'content', 'views'];

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn() => route('product', ['product' => $this->slug])
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function (string $url) {
                if (\Str::startsWith($this->image, ['http://', 'https://', '//'])) {
                    return $this->image;
                } else {
                    return Storage::disk('posts')->url($this->image);
                }
            }
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
