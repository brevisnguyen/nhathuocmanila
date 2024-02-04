<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
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

    public function render()
    {
        return view('livewire.show-category', [
            'products' => $this->queryMedicines()
        ]);
    }
}
