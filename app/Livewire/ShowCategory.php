<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCategory extends Component
{
    use WithPagination;

    public $category;
    public $orderBy;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->generateSeoTags();
    }

    public function filter($orderBy)
    {
        $this->orderBy = $orderBy;
        $this->resetPage();
    }

    protected function queryMedicines()
    {
        $data = Product::whereHas('categories', function ($query) {
            $query->where('category_id', $this->category->id);
        })->when($this->orderBy == 'a2z', function ($query) {
            $query->orderBy('name', 'asc');
        })->when($this->orderBy == 'z2a', function ($query) {
            $query->orderBy('name', 'desc');
        })->when($this->orderBy == 'newest', function ($query) {
            $query->orderBy('updated_at', 'desc');
        })->paginate(20);

        return $data;
    }

    protected function generateSeoTags()
    {
        $category = $this->category;
        $seo_site_name = get_seo_setting('meta_site_name');
        $seo_title = $category->name . '|' . $seo_site_name;
        $seo_description = Str::limit(strip_tags(get_seo_setting('meta_category_description')), 150, '...');
        $seo_keys = explode(',', get_seo_setting('meta_category_keywords'));

        SEOMeta::setTitle($seo_title);
        SEOMeta::setDescription($seo_description);
        SEOMeta::setCanonical($category->url);
        SEOMeta::addMeta('article:published_time', $category->updated_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $seo_title, 'property');
        SEOMeta::addKeyword($seo_keys);

        TwitterCard::setSite($seo_site_name);
        TwitterCard::setTitle($seo_title);
        TwitterCard::setType('summary');
        TwitterCard::setDescription($seo_description);
        TwitterCard::setImage(get_seo_setting('meta_image'));
        TwitterCard::setUrl($category->url);

        OpenGraph::setSiteName($seo_site_name);
        OpenGraph::setTitle($seo_title);
        OpenGraph::setDescription($seo_description);
        OpenGraph::setUrl($category->url);
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'vi-vn');
        OpenGraph::addProperty('locale:alternate', ['vi-vn', 'en-us']);
        OpenGraph::addImage(get_seo_setting('meta_image'));

        JsonLd::setSite($seo_site_name);
        JsonLd::setTitle($seo_title);
        JsonLd::setUrl($category->url);
        JsonLd::setDescription($seo_description);
        JsonLd::setType('Article');
        JsonLd::addImage(get_seo_setting('meta_image'));
    }

    public function render()
    {
        return view('livewire.show-category', [
            'products' => $this->queryMedicines()
        ])
        ->title('Danh mục '.$this->category->name);
    }
}
