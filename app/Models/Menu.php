<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'open_in_new_tab', 'parent_id', 'order'];
    protected $casts = ['open_in_new_tab' => 'boolean'];

    /**
     * =================================================================
     * RELATIONSHIP FOR MENU
     * =================================================================
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * =================================================================
     * BOOT FUNC
     * =================================================================
     */
    protected static function booted(): void
    {
        static::created(function (Menu $menu) {
            // ...
        });
    }
}
