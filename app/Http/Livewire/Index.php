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

    public string   $pageType = 'feed';
    public int      $ID = 0;

    private const ADMIN_ONLY_PAGE = [
        'users',
    ];

    private const MODERATOR_PAGE = [
        'moderation'
    ];

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

    private function checkAccess(string $type): bool
    {
        if (Auth::check()) {
            if (Auth::user()->role('admin'))
                return true;
            if (array_search($type, self::MODERATOR_PAGE) !== false && Auth::user()->role('moderator'))
                return true;
        }
        if (array_search($type, self::PUBLIC_PAGE) !== false)
            return true;
        return false;
    }

    public function  changePage($type = 'feed', $params = [])
    {
        if ($this->checkAccess($type))
            $this->pageType = $type;
        else
            $this->pageType = 'feed';
        $this->ID = $params['id'] ?? 0;
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
        if (!$this->ID)
            $this->ID = intval($_GET['id'] ?? 0);
        return view('livewire.index')
            ->extends('layouts.base');
    }
}
