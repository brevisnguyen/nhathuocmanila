<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Medication;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class HomePage extends Component
{
    public $products;
    public $posts;

    public function mount()
    {
        $this->products = Cache::rememberForever('products', fn() => Medication::popular()->get());
        $this->posts = Post::latest('updated_at')->take(6)->get();
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
