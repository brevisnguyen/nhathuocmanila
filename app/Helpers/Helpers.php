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

if (!function_exists('overWriteEnvFile')) {
    function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                file_put_contents(
                    $path,
                    str_replace($type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path))
                );
            }
            else{
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }
}

if (!function_exists('message')) {
    function message(string $view, array $values = []): string
    {
        return rescue(function () use ($view, $values) {
            return (string) Str::of(view("messages.$view", $values)->render())
                ->replaceMatches('/\r\n|\r|\n/', '')
                ->replace(['<br>', '<BR>'], "\n");
        }, "messages.$view", false);
    }
}
