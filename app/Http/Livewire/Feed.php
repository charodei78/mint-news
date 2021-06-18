<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Feed extends Component
{
    public int      $categoryId = 0;
    public string   $title = '';
    public bool     $favorite = false;
    public bool     $test = false;

    protected $listeners = ['changeCategory'];

    public function changeCategory($id) {
        $category = Category::find($id);
        if ($category) {
            $this->title = $category->name;
            $this->categoryId = $id;
        }
        else {
            $this->categoryId = 0;
            $this->title = '';
        }
    }

    protected function getRecommendations($limit) {
        if (!Auth::check())
            return Post::published()->paginate($limit)->get();
        $recs = Auth::user()->interests();
        $total = array_sum(array_map(fn ($category) => $category['count'], $recs->toArray()));

        $posts = new Collection();

        foreach ($recs as $rec) {
            $k = $rec->count / $total;
            $posts = $posts->merge($rec->posts()->published()
                ->paginate(round($limit * $k + 1, mode: PHP_ROUND_HALF_DOWN)));
        }

        $left = $limit - count($posts);
        if ($left > 0) {
            $posts = $posts->merge(Post::published()->paginate($left));
        }
        $posts = new LengthAwarePaginator($posts, Post::published()->count(), 15);
        return $posts;
    }

    public function render()
    {
        $posts = false;
        if ($this->categoryId) {
            $category = Category::find($this->categoryId);
            if ($category) {
                $filteredPosts = $category->posts()->published()
                    ->paginate(15);
                $this->title = $category->name;
                $posts = $filteredPosts == [] ? false : $filteredPosts;
            }
        }
        else {
            if (Auth::check()) {
                if ($this->favorite) {
                    $posts = Auth::user()->favorite()->published()->paginate(15);
                }
                else
                    $posts = $this->getRecommendations(15);
            }
        }
        if (!$posts) {
            $posts = Post::published()->inRandomOrder()->paginate(15);
        }


        return view('livewire.feed', compact('posts'));
    }

//    public function setCategory($category) {
//        $this->categoryId = $category;
//    }
}
