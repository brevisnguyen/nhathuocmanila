<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchBox extends Component
{
    #[Validate('required|min:2|max:255')]
    public $name = '';

    public $results;
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
        $this->validate();

        $this->redirectRoute('all-products', ['name' => $this->name], true);
    }

    public function render()
    {
        return view('livewire.search-box');
    }
}
