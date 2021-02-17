<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CreatePostPage extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('livewire.create-post-page', compact('categories'));
    }
}
