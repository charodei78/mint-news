<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        $categories = Category::limit(5)->get();
        return view('livewire.category-list', compact('categories'));
    }
}
