<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class RightSidebar extends Component
{
    public function render()
    {
        $posts = Post::orderBy('created_at', 'desc')->limit(5)->get();
        return view('livewire.right-sidebar', compact('posts'));
    }
}
