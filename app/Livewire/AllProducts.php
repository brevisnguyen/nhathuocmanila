<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.all-products', [
            'products' => Product::latest('updated_at')->paginate(15),
        ]);
    }
}
