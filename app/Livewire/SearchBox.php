<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchBox extends Component
{
    public $results;
    public $name;
    public bool $isShow;

    public function mount()
    {
        $this->isShow = false;
        $this->results = collect();
    }

    public function updatedName()
    {
        if (strlen($this->name) < 2) {
            $this->results = collect();
            $this->isShow = false;
            return;
        }

        $this->results = Product::where('name', 'like', '%'.$this->name.'%')->orderBy('name')->get();

        $this->isShow = true;
    }

    public function search()
    {

    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
