<?php

namespace App\Http\Livewire;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post as PostModel;
use App\Models\Category;


class Index extends Component
{
    public $page = 'feed';
    public $category_id = 0;
    public $post_id = 0;

    protected $listeners = ['loadPost', 'changeCategory', 'favoriteChange', 'history-move' => 'historyMove'];

    public function historyMove($params) {
        $this->post_id = intval($params['post'] ?? 0) ;
        $this->category_id = intval($params['category'] ?? 0);
        if ($this->post_id)
            $this->page = 'post';
        else
            $this->page = 'feed';
    }

    public function favoriteChange($inFavorite, $post_id) {
        if (Auth::check()) {
            $user = Auth::user();
            $post = PostModel::findOrFail($post_id);
            if ($inFavorite)
                $user->favorite()->detach($post);
            else
                $user->favorite()->attach($post);
        }
    }

    public function changeCategory($id) {
        if ($id)
            Category::findOrFail($id);
        $this->post_id = 0;
        $this->page = 'feed';
        $this->category_id = $id;
    }

    public function loadPost($id) {
        if (!$id)
            return;
        $post = PostModel::findOrFail($id);
        $this->post_id = $id;
        $this->page = 'post';
        $this->event_post_id= $id;
    }

    public function render()
    {
        if (!$this->category_id)
            $this->category_id = intval($_GET['category'] ?? 0);
        if (!$this->post_id)
            $this->post_id = intval($_GET['post'] ?? 0) ;
        if ($this->post_id)
            $this->page = 'post';
        return view('livewire.index');
    }
}
