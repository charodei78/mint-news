<?php

namespace App\Http\Livewire;

use \Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Post as PostModel;
use App\Models\Category;


class Index extends Component
{
    public $page = 'feed';
    public $category = '';
    public $post_id = 0;
    public $event_post_id = 0;

    protected $listeners = ['loadPost' => 'loadPost'];

    public function changeCategory($id) {
        Category::findOrFail($id);
        $this->post_id = 0;
        $this->page = 'feed';
        $this->event_post_id= 0;
    }

    public function loadPost($id) {
        $post = PostModel::findOrFail($id);
        $this->post_id = $id;
        $this->page = 'post';
        $this->event_post_id= $id;
    }

    public function render()
    {
        $this->category = $_GET['categories'] ?? 0;
        $this->post_id = intval($_GET['post'] ?? $this->event_post_id) ;
        if ($this->post_id)
            $this->page = 'post';
        return view('livewire.index');
    }
}
