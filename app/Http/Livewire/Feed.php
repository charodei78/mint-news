<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Feed extends Component
{
    public $category_id = 0;

    public function render()
    {
        $posts = Post::orderBy('created_at', 'desc')->limit(10);
        if ($this->category_id) {
            $filteredPosts = $posts->where('category', $this->category_id)->get();
            $posts = $filteredPosts == [] ? $posts->get() : $filteredPosts;
        } else {
            $posts = $posts->get();
        }
        return view('livewire.feed', compact('posts'));
    }

    public function setCategory($category) {
        $this->category_id = $category;
    }
}
