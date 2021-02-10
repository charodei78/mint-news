<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Feed extends Component
{
    public $categoryId = 0;
    public $title = '';

    protected $listeners = ['changeCategory'];

    public function changeCategory($id) {
        $category = Category::find($id);
        if ($category) {
            $title = $category->name;
            $this->categoryId = $id;
        }
        else {
            $this->categoryId = 0;
            $this->title = '';
        }
    }

    public function render()
    {
        $posts = Post::orderBy('created_at', 'desc')->limit(10);
        if ($this->categoryId) {
            $category_id = $this->categoryId;
            $filteredPosts = Post::whereHas('categories', function (Builder $query) use ($category_id)  { $query->where('id', $category_id); } )
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
            $category = Category::find($this->categoryId);
            if ($category)
                $this->title = $category->name;
            else
                $this->title = '';
            $posts = $filteredPosts == [] ? $posts->get() : $filteredPosts;
        } else {
            $posts = $posts->get();
        }
        return view('livewire.feed', compact('posts'));
    }

//    public function setCategory($category) {
//        $this->categoryId = $category;
//    }
}
