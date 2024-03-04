<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AllProducts extends Component
{
    use WithPagination;

    #[Url]
    public string $name = '';

    public function render()
    {
        return view('livewire.all-products', [
            'products' => Product::when($this->name != '', function ($query) {
                $query->where('name', 'LIKE', '%'.$this->name.'%');
            })
            ->latest('updated_at')
            ->paginate(15),
        ]);
    }
}
