<?php

namespace App\Livewire;

use App\Models\Category;
use App\Settings\WebSettings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Header extends Component
{
    public Collection $categories;
    public Collection $website;

    public function mount()
    {
        $this->categories = Cache::rememberForever('categories', fn() => Category::all());
        $this->website = (new WebSettings())->toCollection();
    }

    public function render()
    {
        return view('livewire.header');
    }
}
