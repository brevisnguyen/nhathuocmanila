<?php

namespace App\Livewire;

use App\Services\CartManager;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $default_sku;

    public function addToCart()
    {
        CartManager::add($this->default_sku->id, 1, $this->default_sku->amount);
        $this->dispatch('cart-updated');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->default_sku = $product->productUnits->firstWhere('default', true);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
