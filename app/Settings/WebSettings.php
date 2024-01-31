<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class WebSettings extends Settings
{
    public string $telegram;
    public string $facebook;
    public string $tiktok;
    public string $hotline;
    public string $logo;
    public array $banner;

    public static function group(): string
    {
        return 'website';
    }
}
