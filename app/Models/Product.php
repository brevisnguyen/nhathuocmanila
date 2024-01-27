<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);

        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300);

        $this->addMediaConversion('large')
            ->width(800)
            ->height(800);
    }
}
