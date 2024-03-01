<?php

namespace App\Livewire;

use App\Services\CartManager;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $sku;

    public function addToCart()
    {
        CartManager::add(
            $this->sku->id,
            $this->product->id,
            $this->sku->unit_id,
            1,
            $this->sku->amount
        );

        $this->dispatch('cart-updated');
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->sku = $product->productUnits->firstWhere('default', true);
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}
