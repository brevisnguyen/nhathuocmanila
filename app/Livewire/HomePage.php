<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Product;
use App\Settings\WebSettings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class HomePage extends Component
{
    public $posts;
    public array $banners;
    public $flash_sale;
    public $products;

    public function mount()
    {
        $this->banners = $this->getBanners();
        $this->posts = Post::latest('updated_at')->limit(5)->get();
        $this->flash_sale = $this->getFlashSale();
        $this->products = Product::orderBy('updated_at')->limit(20)->get();
    }

    private function getBanners(): array
    {
        $banners = app(WebSettings::class)->banner;

        foreach ($banners as $key => &$img) {
            if (Storage::disk('public')->exists($img)) {
                $img = Storage::disk('public')->url($img);
            } else {
                unset($banners[$key]);
            }
        }
        return $banners;
    }

    private function getFlashSale()
    {
        return Cache::remember(
            'flash_sale_today',
            now()->endOfDay(),
            fn () => Product::inRandomOrder()->limit(15)->get()
        );
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
