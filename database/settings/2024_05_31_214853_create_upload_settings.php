<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('upload.slider', []);
        $this->migrator->add('upload.homepage_mid_banner', '');
        $this->migrator->add('upload.thumb', ['width' => 100, 'height' => 100]);
        $this->migrator->add('upload.medium', ['width' => 350, 'height' => 350]);
        $this->migrator->add('upload.large', ['width' => 640, 'height' => 640]);
    }
};
