<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'components', 'price', 'cost', 'unit_id', 'inventory', 'sold_count', 'image', 'description'];

    protected $casts = ['components' => 'array'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_medication');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_medication')->withPivot(['quantity', 'amount']);
    }

    protected static function booted(): void
    {
        static::deleted(function (Medication $medication) {
            $file_name = basename($medication->image);
            if (Storage::disk('medicines')->exists($file_name)) {
                Storage::disk('medicines')->delete($file_name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeHasName(Builder $query, $search)
    {
        $query->where('name', 'LIKE', '%' . $search . '%');
    }

    public function scopeHasComponent(Builder $query, $search)
    {
        $query->orWhere('components', 'LIKE', '%' . $search . '%');
    }

    public function scopePopular(Builder $query)
    {
        $query->orderByDesc('sold_count')->take(10);
    }

    public function getImage()
    {
        if (Str::startsWith($this->image, ['http://', 'https://', '//'])) {
            return $this->image;
        } else {
            return Storage::disk('medicines')->url($this->image);
        }
    }

    public function getUrl(): string
    {
        return route('products', ['medication' => $this->slug]);
    }
}
