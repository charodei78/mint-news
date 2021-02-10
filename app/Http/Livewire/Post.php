<?php

namespace App\Http\Livewire;

use App\Models\Post as PostModel;

use Livewire\Component;

class Post extends Component
{
    public $postId = 0;

    public function render()
    {
        $post = PostModel::find($this->postId);
        if ($post)
            return view('livewire.post', compact('post'));
        else
            return <<<'blade'
            <div>
                404
            </div>
        blade;
    }
}
