<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Medication extends Model
{
    use HasFactory;

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
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
}
