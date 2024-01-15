<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'featured_image', 'content', 'views'];

    public function getUrl(): string
    {
        return route('post.show', ['post' => $this->slug]);
    }

    public function getImage(): string
    {
        if (Str::startsWith($this->featured_image, ['http://', 'https://', '//'])) {
            return $this->featured_image;
        } else {
            return Storage::disk('medicines')->url($this->featured_image);
        }
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
