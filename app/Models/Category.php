<?php

namespace App\Models;

use App\Settings\WebSettings;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(
                \Spatie\Image\Enums\Fit::Crop,
                intval(app(WebSettings::class)->thumb_size[0]),
                intval(app(WebSettings::class)->thumb_size[1]),
            );

        $this->addMediaConversion('medium')
            ->fit(
                \Spatie\Image\Enums\Fit::Crop,
                intval(app(WebSettings::class)->medium_size[0]),
                intval(app(WebSettings::class)->medium_size[1]),
            );

        $this->addMediaConversion('large')
            ->fit(
                \Spatie\Image\Enums\Fit::Crop,
                intval(app(WebSettings::class)->large_size[0]),
                intval(app(WebSettings::class)->large_size[1]),
            );
    }
}
