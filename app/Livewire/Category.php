<?php

namespace App\Livewire;

use App\Models\Category as Grade;
use App\Models\Medication;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    public $category;
    public $orderBy;

    public function mount(Grade $category)
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
        $data = Medication::whereHas('categories', function ($query) {
            $query->where('category_id', $this->category->id);
        })->when($this->orderBy == 'highest', function ($query) {
            $query->orderBy('price', 'desc');
        })->when($this->orderBy == 'lowest', function ($query) {
            $query->orderBy('price', 'asc');
        })->when($this->orderBy == 'newest', function ($query) {
            $query->orderBy('updated_at', 'desc');
        })->paginate(20);

        return $data;
    }

    public function render()
    {
        return view('livewire.category', [
            'products' => $this->queryMedicines()
        ]);
    }
}
