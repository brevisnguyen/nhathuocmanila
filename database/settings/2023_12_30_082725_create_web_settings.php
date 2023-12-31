<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('website.facebook', 'https://www.facebook.com/brevisng');
        $this->migrator->add('website.tiktok', 'https://www.tiktok.com/@nhathuocmanila');
        $this->migrator->add('website.telegram', 'https://t.me/nhathuocmanila');
        $this->migrator->add('website.phone', '09854359999');
    }
};
