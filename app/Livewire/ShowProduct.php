<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Services\CartManager;
use Illuminate\Support\Collection;
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

    public function render()
    {
        return view('livewire.show-product');
    }
}
