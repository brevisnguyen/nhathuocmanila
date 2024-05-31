<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class UploadSettings extends Settings
{
    public ?array $slider;
    public ?string $homepage_mid_banner;
    public ?array $thumb;
    public ?array $medium;
    public ?array $large;

    public static function group(): string
    {
        return 'upload';
    }
}
