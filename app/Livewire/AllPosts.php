<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;

    #[Title('Bài viết mới nhất')]
    public function render()
    {
        return view('livewire.all-posts', [
            'posts' => Post::latest('updated_at')->paginate(12),
        ]);
    }
}
