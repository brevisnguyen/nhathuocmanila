<?php

namespace App\Livewire;

use App\Models\Post as Blog;
use Livewire\Component;

class Post extends Component
{
    public $post;

    public function mount(Blog $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $posts = Blog::where('id', '<>', $this->post->id)->take(6)->get();

        return view('livewire.post', [
            'posts' => $posts,
        ]);
    }
}
