<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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

    protected function getRecommendations($limit) {
        if (!Auth::check())
            return Post::limit($limit)->get();
        $recs = Auth::user()->interests();
        $total = array_sum(array_map(fn ($category) => $category['count'], $recs->toArray()));


        $posts = new Collection();

        foreach ($recs as $rec) {
            $k = $rec->count / $total;
            $posts = $posts->merge($rec->posts()
                ->limit(round($limit * $k + 1, mode: PHP_ROUND_HALF_DOWN))
                ->offset(rand(0, 10))
                ->get());
            echo round($limit * $k, mode: PHP_ROUND_HALF_DOWN).' ';
        }
        $left = $limit - count($posts);
        return $posts;
    }

    public function render()
    {
        $posts = Post::limit(10);
        $category =  Category::find($this->categoryId);
        if ($category) {
            $filteredPosts = $category->posts()
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
            $posts = $this->getRecommendations(10);
        }
        return view('livewire.feed', compact('posts'));
    }

//    public function setCategory($category) {
//        $this->categoryId = $category;
//    }
}
