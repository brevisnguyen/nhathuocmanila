<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image', 'description', 'sold', 'status'];
    protected $casts = ['status' => Status::class];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(ProductUnit::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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
                    return Storage::disk('products')->url($this->image);
                }
            }
        );
    }
}
