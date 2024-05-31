<?php

namespace App\Models;

use App\Enums\Status;
use App\Settings\UploadSettings;
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

    /**
     * =================================================================
     * RELATIONSHIP FOR PRODUCT
     * =================================================================
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class, 'product_unit')->withPivot(['amount', 'default', 'id']);
    }

    public function productUnits(): HasMany
    {
        return $this->hasMany(ProductUnit::class);
    }

    /**
     * =================================================================
     * ATTRIBUTE FOR PRODUCT
     * =================================================================
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn() => route('product', ['product' => $this->slug])
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function registerMediaConversions(Media|null $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(
                \Spatie\Image\Enums\Fit::Crop,
                intval(app(UploadSettings::class)->thumb['width']),
                intval(app(UploadSettings::class)->thumb['height']),
            );

        $this->addMediaConversion('medium')
            ->fit(
                \Spatie\Image\Enums\Fit::Crop,
                intval(app(UploadSettings::class)->medium['width']),
                intval(app(UploadSettings::class)->medium['height']),
            );

        $this->addMediaConversion('large')
            ->fit(
                \Spatie\Image\Enums\Fit::Crop,
                intval(app(UploadSettings::class)->large['width']),
                intval(app(UploadSettings::class)->large['height']),
            );
    }
}
