<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class MyPosts extends Component
{
    use WithPagination;

    public string   $orderBy = "id";
    public int      $filter = -1;
    public bool     $asc = false;
    public int      $paginate = 10;

    public function deletePost($id, $force = false)
    {
        $post = Auth::user()->posts()->findOrFail($id);
        if ($force)
        {
            $path = 'public/post_images/'.$post->id;
            if (Storage::exists($path))
                Storage::deleteDirectory($path);
            $post->forceDelete();
        } else {
            $post->delete();
        }
    }

    public function render()
    {
        $posts = Auth::user()
            ->posts()
            ->select('id', 'title', 'synopsys', 'preview', 'views', 'created_at');
        if ($this->filter != -1)
            $posts->where('status', $this->filter);
        $posts = $posts
            ->orderBy($this->orderBy, $this->asc ? 'asc' : 'desc')
            ->paginate($this->paginate);
        $filters = [-1 => __('все')] + Post::POST_STATUS;
        return view('livewire.my-posts', compact('posts','filters'));
    }
}
