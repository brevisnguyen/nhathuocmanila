<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $site_brand;
    public ?string $site_slogan;
    public ?string $site_logo;
    public ?string $site_cache_ttl;
    public ?string $additional_footer_js;

    public static function group(): string
    {
        return 'general';
    }
}
