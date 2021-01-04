<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Search extends Component
{
    public string $input = '';
    public string $class = '';

    public function render()
    {
//        $posts = DB::select('SELECT * FROM (SELECT id, title, preview, views,  created_at, similarity(title, CAST (? as varchar)) as sim
//            FROM posts) as tmp
//            WHERE sim >= 0.5
//            ORDER BY sim DESC, created_at DESC
//            LIMIT 5
//        ', [$this->input]);
        $posts = Post::orderBy('created_at', 'desc')->limit(5)->get();
//            ->where(',', 'like', $this->input.'%')
//            ->orderBy('created_at', 'desc')
//            ->limit(5)
//            ->get();
        return view('livewire.search', compact('posts'));
    }
}