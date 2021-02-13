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

    private const AUTH_ONLY_PAGE = [
        'settings',
        'create-post'
    ];

    private const PUBLIC_PAGE = [
        'feed',
        'post',
    ];

    protected $listeners = [
        'loadPost',
        'changeCategory',
        'favoriteChange',
        'likeChange',
        'history-move' => 'historyMove',
        'open-settings' => 'openSettings',
        'open-create-post' => 'openCreatePost',
    ];

    public function openSettings ()
    {
        $this->category_id = 0;
        $this->post_id = 0;
        $this->page = 'settings';
    }

    public function historyMove($params)
    {
        $this->post_id = intval($params['post'] ?? 0) ;
        $this->category_id = intval($params['category'] ?? 0);
        if ($this->post_id)
            $this->page = 'post';
        else
            $this->page = 'feed';
        $this->page = $params['page'] ?? $this->page;
    }

    public function  openCreatePost() {
        $this->page = 'create-post';
        $this->post_id = 0;
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

    public function changeCategory($id)
    {
        if ($id)
            Category::findOrFail($id);
        $this->post_id = 0;
        $this->page = 'feed';
        $this->category_id = $id;
        $this->emit('changePage');
    }

    public function loadPost($id)
    {
        if (!$id)
            return;
        $post = PostModel::findOrFail($id);
        $this->post_id = $id;
        $this->page = 'post';
        $this->event_post_id= $id;
        $this->emit('changePage');
    }


    public function mount($type ='feed')
    {
        if (array_search($type, self::PUBLIC_PAGE) !== false ||
            (array_search($type, self::AUTH_ONLY_PAGE) !== false && Auth::check())
        ) {
            $this->page = $type;
        }
        else
            $this->page = 'feed';

    }

    public function render()
    {
        if (!$this->category_id)
            $this->category_id = intval($_GET['category'] ?? 0);
        if (!$this->post_id)
            $this->post_id = intval($_GET['post'] ?? 0) ;
        if ($this->post_id)
            $this->page = 'post';
        return view('livewire.index')
            ->extends('layouts.base');
    }
}
