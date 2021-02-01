<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Feed extends Component
{
    public function render()
    {
        $posts = Post::orderBy('created_at', 'desc')->limit(10)->get();
        return view('livewire.feed', compact('posts'));
    }
}
