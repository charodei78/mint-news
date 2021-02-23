<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Search extends Component
{
    public string $input = '';

    protected $listeners = ['loadPost' => 'resetSearch', 'changeCategory' => 'resetSearch'];

    public function resetSearch() {
        $this->input = '';
        $this->dispatchBrowserEvent('reset-search');
    }

    public function render()
    {
//        $posts = DB::select('SELECT * FROM (SELECT id, title, preview, views,  created_at, similarity(title, CAST (? as varchar)) as sim
//            FROM posts) as tmp
//            WHERE sim >= 0.5
//            ORDER BY sim DESC, created_at DESC
//            LIMIT 5
//        ', [$this->input]);
        if (strlen($this->input) > 3)
            $posts = Post::where('title', 'ILIKE', '%'.$this->input.'%')->orderBy('created_at', 'desc')->limit(5)->get();
        else
            $posts = [];
//            ->where(',', 'like', $this->input.'%')
//            ->orderBy('created_at', 'desc')
//            ->limit(5)
//            ->get();
        return view('livewire.search', compact('posts'));
    }
}
