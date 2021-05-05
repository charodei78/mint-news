<?php

namespace App\Http\Livewire;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Post as PostModel;
use App\Models\Category;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;

    public $pageType = 'feed';
    public $category_id = 0;
    public $post_id = 0;

    private const AUTH_ONLY_PAGE = [
        'settings',
        'edit-post',
        'my-posts',
        'favorite'
    ];

    private const PUBLIC_PAGE = [
        'feed',
        'post',
        'policy',
    ];

    protected $listeners = [
        'favoriteChange',
        'likeChange',
        'history-move' => 'historyMove',
        'changePage'
    ];

    public function historyMove($params)
    {
        $this->post_id = intval($params['post'] ?? 0) ;
        $this->category_id = intval($params['category'] ?? 0);
        if ($this->post_id)
            $this->pageType = 'post';
        else
            $this->pageType = 'feed';
        $this->pageType = $params['page'] ?? $this->pageType;
    }

    public function  changePage($type = 'feed', $params = []) {
        if (array_search($type, self::PUBLIC_PAGE) !== false ||
            (array_search($type, self::AUTH_ONLY_PAGE) !== false && Auth::check())
        ) {
            $this->pageType = $type;
        }
        else
            $this->pageType = 'feed';
        $this->post_id = $params['post_id'] ?? 0;
        $this->category_id = $params['category_id'] ?? 0;
    }

    public function favoriteChange($inFavorite, $post_id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $post = PostModel::findOrFail($post_id);
            if ($inFavorite)
                $user->favorite()->detach($post);
            else
                $user->favorite()->attach($post);
        }
    }

    public function likeChange($liked, $post_id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $post = PostModel::findOrFail($post_id);
            if ($liked)
                $user->liked()->detach($post);
            else
                $user->liked()->attach($post);
        }
    }

    public function mount($type ='feed')
    {
        $this->changePage($type);
    }

    public function render()
    {
        if (!$this->category_id)
            $this->category_id = intval($_GET['category_id'] ?? 0);
        if (!$this->post_id)
            $this->post_id = intval($_GET['post_id'] ?? 0) ;
        return view('livewire.index')
            ->extends('layouts.base');
    }
}
