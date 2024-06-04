<?php

use Illuminate\Support\Facades\Cache;
use App\Settings\SeoSettings;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_seo_setting')) {
    function get_seo_setting($key, $default = null)
    {
        $value = app(SeoSettings::class)->$key;

        if (is_null($value)) return $default;

        return $value;
    }
}

if (!function_exists('getFavicon')) {
    function getFavicon()
    {
        $favicon = app(SeoSettings::class)?->meta_favicon;

        if (is_null($favicon)) return null;

        $disk = config('filament.default_filesystem_disk');

        if (Storage::disk($disk)->exists($favicon)) {
            return Storage::disk($disk)->url($favicon);
        }

        return null;
    }
}
