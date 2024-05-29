<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Menu;
use App\Settings\WebSettings;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Header extends Component
{
    public Collection $categories;
    public Collection $website;
    public Collection $menu;

    public function mount()
    {
        $this->categories = Cache::rememberForever('categories', fn() => Category::all());
        $this->website = (new WebSettings())->toCollection();
        $this->menu = Cache::remember('nhathuocmanila_menu_key', 24 * 3600, function () {
            return Menu::whereNull('parent_id')->with('children')->get();
        });
    }

    public function render()
    {
        return view('livewire.header');
    }
}
