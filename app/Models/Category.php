<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn() => route('category', ['category' => $this->slug])
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function (string $url) {
                if (\Str::startsWith($this->image, ['http://', 'https://', '//'])) {
                    return $this->image;
                } else {
                    return Storage::disk('categories')->url($this->image);
                }
            }
        );
    }
}
