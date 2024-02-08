<?php

namespace App\Livewire;

use App\Services\CartManager;
use Livewire\Attributes\On;
use Livewire\Component;

class CartCount extends Component
{
    public int $count;

    #[On('cart-updated')]
    public function onCartUpdated()
    {
        $this->mount();
    }

    public function mount()
    {
        $this->count = CartManager::count();
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
