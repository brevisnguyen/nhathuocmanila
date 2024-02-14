<?php

namespace App\Livewire;

use App\Services\CartManager;
use Illuminate\Support\Collection;
use Livewire\Component;

class ShowCart extends Component
{
    public Collection $items;
    public $subtotal = 0;

    public function updateItem($id, $quantity)
    {
        CartManager::update($id, $quantity);

        $this->mount();
    }

    public function remove($id)
    {
        CartManager::remove($id);

        $this->dispatch('cart-updated');
        $this->mount();
    }

    public function mount()
    {
        $this->items = CartManager::items();
        $this->subtotal = CartManager::subtotal();
    }

    public function render()
    {
        return view('livewire.show-cart');
    }
}
