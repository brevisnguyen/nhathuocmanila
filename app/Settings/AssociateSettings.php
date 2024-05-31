<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AssociateSettings extends Settings
{
    public ?string $telegram;
    public ?string $facebook;
    public ?string $tiktok;
    public ?string $hotline;

    public static function group(): string
    {
        return 'associate';
    }
}
