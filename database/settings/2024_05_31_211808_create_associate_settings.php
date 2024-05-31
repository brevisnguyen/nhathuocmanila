<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('associate.telegram', '');
        $this->migrator->add('associate.facebook', '');
        $this->migrator->add('associate.tiktok', '');
        $this->migrator->add('associate.hotline', '');
    }
};
