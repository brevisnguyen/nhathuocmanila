<?php

namespace App\Livewire;

use App\Models\Medication;
use App\Models\Post;
use Livewire\Component;

class HomePage extends Component
{
    public $posts;
    public $hot_products;
    public $newest_products;

    public function mount()
    {
        $this->hot_products = Medication::popular()->take(20)->get();
        $this->newest_products = Medication::where('inventory', '>', 0)->latest('updated_at')->take(20)->get();
        $this->posts = Post::latest('updated_at')->take(6)->get();
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
