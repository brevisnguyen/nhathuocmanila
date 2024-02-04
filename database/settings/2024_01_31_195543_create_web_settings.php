<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('website.telegram', '');
        $this->migrator->add('website.facebook', '');
        $this->migrator->add('website.tiktok', '');
        $this->migrator->add('website.hotline', '');
        $this->migrator->add('website.logo', '');
        $this->migrator->add('website.banner', []);
        $this->migrator->add('website.mid_banner', '');
        $this->migrator->add('website.thumb_size', [100, 100]);
        $this->migrator->add('website.medium_size', [350, 350]);
        $this->migrator->add('website.large_size', [640, 640]);
    }
};
