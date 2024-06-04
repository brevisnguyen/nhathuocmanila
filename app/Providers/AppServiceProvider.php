<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config([
            'seotools.meta.defaults.title' => get_seo_setting('meta_title'),
            'seotools.meta.defaults.description' => get_seo_setting('meta_description'),
            'seotools.meta.defaults.keywords' => [get_seo_setting('meta_keywords')],
            'seotools.meta.defaults.canonical' => url('/')
        ]);

        config([
            'seotools.opengraph.defaults.title' => get_seo_setting('meta_title'),
            'seotools.opengraph.defaults.description' => get_seo_setting('meta_description'),
            'seotools.opengraph.defaults.type' => 'website',
            'seotools.opengraph.defaults.url' => url('/'),
            'seotools.opengraph.defaults.site_name' => get_seo_setting('meta_site_name'),
            'seotools.opengraph.defaults.images' => [get_seo_setting('meta_image')],
        ]);

        config([
            'seotools.twitter.defaults.card' => 'website',
            'seotools.twitter.defaults.title' => get_seo_setting('meta_title'),
            'seotools.twitter.defaults.description' => get_seo_setting('meta_description'),
            'seotools.twitter.defaults.url' => url('/'),
            'seotools.twitter.defaults.site' => get_seo_setting('meta_site_name'),
            'seotools.twitter.defaults.image' => get_seo_setting('meta_image'),
        ]);

        config([
            'seotools.json-ld.defaults.title' => get_seo_setting('meta_title'),
            'seotools.json-ld.defaults.type' => 'WebPage',
            'seotools.json-ld.defaults.description' => get_seo_setting('meta_description'),
            'seotools.json-ld.defaults.images' => get_seo_setting('meta_image'),
        ]);
    }
}
