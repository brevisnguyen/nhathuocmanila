<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('seo.meta_title', '');
        $this->migrator->add('seo.meta_site_name', '');
        $this->migrator->add('seo.meta_favicon', '');
        $this->migrator->add('seo.meta_description', '');
        $this->migrator->add('seo.meta_keywords', '');
        $this->migrator->add('seo.meta_image', '');
        $this->migrator->add('seo.social_facebook_app_id', '');
        $this->migrator->add('seo.scripts_facebook_sdk', '');
        $this->migrator->add('seo.scripts_google_analytics', '');

        $this->migrator->add('seo.meta_category_title', '');
        $this->migrator->add('seo.meta_category_description', '');
        $this->migrator->add('seo.meta_category_keywords', '');

        $this->migrator->add('seo.meta_product_title', '');
        $this->migrator->add('seo.meta_product_description', '');
        $this->migrator->add('seo.meta_product_keywords', '');

        $this->migrator->add('seo.meta_post_title', '');
        $this->migrator->add('seo.meta_post_description', '');
        $this->migrator->add('seo.meta_post_keywords', '');
    }
};
