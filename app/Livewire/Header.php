<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Header extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = Cache::rememberForever('categories', fn() => Category::take(10)->get());
    }

    public function render()
    {
        return view('livewire.header');
    }
}
