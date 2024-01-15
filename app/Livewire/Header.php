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
        $this->categories = Cache::rememberForever('categories', fn() => Category::all());
    }

    protected function getMenu()
    {
        return array(
            ['title' => 'Trang chủ', 'url' => route('home')],
            ['title' => 'Thuốc', 'url' => route('home')],
            ['title' => 'Tin tức', 'url' => route('home')],
            ['title' => 'Giới thiệu', 'url' => route('home')],
        );
    }

    public function render()
    {
        return view('livewire.header');
    }
}
