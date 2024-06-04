<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Services\CartManager;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class ShowProduct extends Component
{
    public $product;
    public Collection $relatedProducts;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->relatedProducts = $this->getRelateProducts();
        $this->generateSeoTags();
    }

    public function addToCart(int $unit_id, int $quantity)
    {
        $sku = ProductUnit::where([
            ['product_id', $this->product->id],
            ['unit_id', $unit_id]
        ])->first();

        if ($sku) {
            CartManager::add($sku->id, $sku->product_id, $unit_id, $quantity, $sku->amount);
            $this->dispatch('cart-updated');
        }
    }

    protected function getRelateProducts()
    {
        $data = collect([]);
        try {
            $query = product::query();
            $category_ids = $this->product->categories->pluck('id')->toArray();
            $query = Product::whereHas('categories', function ($query) use ($category_ids) {
                return $query->whereIn('category_id', $category_ids);
            });
            $data = $query->get();
        } catch (\Throwable $th) {
        }
        return $data;
    }

    protected function generateSeoTags()
    {
        $product = $this->product;
        $seo_site_name = get_seo_setting('meta_site_name');
        $seo_title = $product->name . '|' . $seo_site_name;
        $seo_description = Str::limit(strip_tags($product->description), 150, '...');
        $seo_keys = explode(',', get_seo_setting('meta_product_keywords'));

        SEOMeta::setTitle($seo_title);
        SEOMeta::setDescription($seo_description);
        SEOMeta::setCanonical($product->url);
        SEOMeta::addMeta('article:published_time', $product->updated_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $seo_title, 'property');
        SEOMeta::addKeyword($seo_keys);

        TwitterCard::setSite($seo_site_name);
        TwitterCard::setTitle($seo_title);
        TwitterCard::setType('summary');
        TwitterCard::setImage($product->getFirstMediaUrl('products', 'large'));
        TwitterCard::setDescription($seo_description);
        TwitterCard::setUrl($product->url);

        OpenGraph::setSiteName($seo_site_name);
        OpenGraph::setTitle($seo_title);
        OpenGraph::setDescription($seo_description);
        OpenGraph::setUrl($product->url);
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'vi-vn');
        OpenGraph::addProperty('locale:alternate', ['vi-vn', 'en-us']);
        OpenGraph::addImage($product->getFirstMediaUrl('products', 'large'));

        JsonLd::setSite($seo_site_name);
        JsonLd::setTitle($seo_title);
        JsonLd::setUrl($product->url);
        JsonLd::setDescription($seo_description);
        JsonLd::setType('Article');
        JsonLd::addImage($product->getFirstMediaUrl('products', 'large'));
    }

    public function render()
    {
        return view('livewire.show-product')
            ->title('Thuốc '.$this->product->name);
    }
}
