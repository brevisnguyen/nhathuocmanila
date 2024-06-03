<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoSettings extends Settings
{
    public ?string $meta_title;
    public ?string $meta_site_name;
    public ?string $meta_favicon;
    public ?string $meta_description;
    public ?string $meta_keywords;
    public ?string $meta_image;
    public ?string $meta_category_title;
    public ?string $meta_category_description;
    public ?string $meta_category_keywords;
    public ?string $meta_product_title;
    public ?string $meta_product_description;
    public ?string $meta_product_keywords;
    public ?string $meta_post_title;
    public ?string $meta_post_description;
    public ?string $meta_post_keywords;

    public static function group(): string
    {
        return 'seo';
    }
}
