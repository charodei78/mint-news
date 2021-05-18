<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Moderation extends Component
{
    use WithPagination;

    public string   $orderBy = "id";
    public int      $filter = -1;
    public bool     $asc = false;
    public int      $paginate = 10;

    public function render()
    {
        $posts = Post::select('id', 'title', 'synopsys', 'preview', 'views', 'created_at')
            ->where('status', '!=', 0);
        if ($this->filter != -1)
            $posts->where('status', $this->filter);
        $posts = $posts
            ->orderBy($this->orderBy, $this->asc ? 'asc' : 'desc')
            ->paginate($this->paginate);
        $filter_values = [-1 => __('все')] + array_diff(Post::POST_STATUS, [Post::POST_STATUS[0]]);
        return view('livewire.moderation', compact('posts', 'filter_values'));
    }
}
