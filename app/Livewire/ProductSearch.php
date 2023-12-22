<?php

namespace App\Livewire;

use App\Models\Medication;
use Livewire\Component;

class ProductSearch extends Component
{
    public $query;
    public $products = [];

    public function mount()
    {
        $this->query = '';
        $this->products = collect([]);
    }

    public function updatedQuery()
    {
        $this->query = trim($this->query);

        if (strlen($this->query) >= 2) {
            $data = Medication::hasName($this->query)->hasComponent($this->query)->limit(5)->get();
            $this->products = $data == null ? collect([]) : $data;
        } else {
            $this->query = '';
            $this->products = collect([]);
        }
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
