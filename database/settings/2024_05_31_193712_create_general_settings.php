<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_brand', '');
        $this->migrator->add('general.site_slogan', '');
        $this->migrator->add('general.site_logo', '');
        $this->migrator->add('general.site_cache_ttl', '');
        $this->migrator->add('general.telegram_token', '');
        $this->migrator->add('general.additional_footer_js', '');
    }
};
