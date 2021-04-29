<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class MyPosts extends Component
{
    use WithPagination;

    public string   $orderBy = "id";
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
            ->select('id', 'title', 'synopsys', 'preview', 'synopsis', 'views', 'created_at')
            ->orderBy($this->orderBy, $this->asc ? 'asc' : 'desc')
            ->paginate($this->paginate);
        return view('livewire.my-posts', compact('posts'));
    }
}
