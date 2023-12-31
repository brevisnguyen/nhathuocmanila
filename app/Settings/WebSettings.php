<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class WebSettings extends Settings
{
    public string $facebook;
    public string $tiktok = '';
    public string $telegram = '';
    public string $phone = '';
    public array $hero_banner;

    public static function group(): string
    {
        return 'website';
    }
}
