<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $site_brand;
    public ?string $site_slogan;
    public ?string $site_logo;
    public ?string $site_cache_ttl;
    public ?string $site_facebook_app_id;
    public ?string $site_scripts_facebook_sdk;
    public ?string $site_scripts_google_analytics;
    public ?string $additional_footer_js;

    public static function group(): string
    {
        return 'general';
    }
}
