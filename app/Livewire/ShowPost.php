<?php

namespace App\Livewire;

use App\Models\Post as Blog;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;

    public function mount(Blog $post)
    {
        $this->post = $post;
        $this->generateSeoTags();
    }

    protected function generateSeoTags()
    {
        $post = $this->post;
        $seo_site_name = get_seo_setting('meta_site_name');
        $seo_title = $post->title . '|' . $seo_site_name;
        $seo_description = Str::limit(strip_tags($post->content), 150, '...');
        $seo_keys = explode(',', get_seo_setting('meta_post_keywords'));

        SEOMeta::setTitle($seo_title);
        SEOMeta::setDescription($seo_description);
        SEOMeta::setCanonical($post->url);
        SEOMeta::addMeta('article:published_time', $post->updated_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $seo_title, 'property');
        SEOMeta::addKeyword($seo_keys);

        TwitterCard::setSite($seo_site_name);
        TwitterCard::setTitle($seo_title);
        TwitterCard::setType('summary');
        TwitterCard::setImage($post->getFirstMediaUrl('posts', 'large'));
        TwitterCard::setDescription($seo_description);
        TwitterCard::setUrl($post->url);

        OpenGraph::setSiteName($seo_site_name);
        OpenGraph::setTitle($seo_title);
        OpenGraph::setDescription($seo_description);
        OpenGraph::setUrl($post->url);
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'vi-vn');
        OpenGraph::addProperty('locale:alternate', ['vi-vn', 'en-us']);
        OpenGraph::addImage($post->getFirstMediaUrl('posts', 'large'));

        JsonLd::setSite($seo_site_name);
        JsonLd::setTitle($seo_title);
        JsonLd::setUrl($post->url);
        JsonLd::setDescription($seo_description);
        JsonLd::setType('Article');
        JsonLd::addImage($post->getFirstMediaUrl('posts', 'large'));
    }

    public function render()
    {
        $posts = Blog::where('id', '<>', $this->post->id)->take(6)->get();

        return view('livewire.show-post', [
            'posts' => $posts,
        ])
        ->title($this->post->title);
    }
}
