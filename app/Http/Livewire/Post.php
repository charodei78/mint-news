<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post as PostModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Post extends Component
{
    public $postId = 0;
    public $files = [];

    public function loadImage(Request $request) {
//        $this->validate();
        $this->files = array_merge( $this->files, $request->allFiles());
        print_r( $this->files);
    }

    public function render()
    {
        $post = PostModel::find($this->postId);
        if ($post) {
            if (Auth::check()) {
                $view = $post->viewedBy()->where('user_id', '=', Auth::id())->first();
                if (!$view)
                    $post->viewedBy()->attach(Auth::user());
            }
            return view('livewire.post', compact('post'));
        }
        else
            return redirect()->to('/');
    }
}
