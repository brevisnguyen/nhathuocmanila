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
        $this->migrator->add('general.site_facebook_app_id', '');
        $this->migrator->add('general.site_scripts_facebook_sdk', '');
        $this->migrator->add('general.site_scripts_google_analytics', '');
        $this->migrator->add('general.additional_footer_js', '');
    }
};
