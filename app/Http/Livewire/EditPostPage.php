<?php

namespace App\Http\Livewire;

use App\Models\Category;
use http\QueryString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use function Livewire\str;


class EditPostPage extends Component
{
    use WithFileUploads;

    public Post     $post;
    public array    $checked_categories;
    public          $preview;
    public          $postId = 0;

    protected $queryString = ['postId'];

    protected array $rules = [
        'post.title' => 'required|min:20|max:80',
        'post.preview' => 'image',
        'post.synopsis' => 'required|min:20|max:160',
        'post.body' => 'required|min:400|max:16000',
    ];

    public function mount($id)
    {
        if (!$this->postId)
            $this->postId = $id;
        $post = Post::find($this->postId);

        if ($post && Auth::user()->cannot('update', $post))
            abort(403);
        if ($post == null) {
            $post = new Post;
            $post->user_id = Auth::user()->id;
            $post->title = "";
            $post->preview = "";
            $post->synopsis = "";
            $post->body = "";
            $post->status = 0;
            $post->save();
        }
        $this->post = $post;
        $this->postId = $post->id;
        $this->checked_categories = $post->categories->getQueueableIds();
    }

    public function updated($name, $value)
    {
        if (Auth::user()->cannot('update', $this->post))
            abort(403);
        switch ($name) {
            case 'preview':
                $path = 'public/post_images/'.$this->post->id;
                $preview_path = $path.'/preview';
                if (Storage::exists($preview_path))
                    Storage::delete($preview_path);
                if ($this->preview)
                    $this->post->preview = Str($this->preview->storeAs($path, 'preview'))
                        ->replace('public','storage');
                else
                    $this->post->preview = "";
                break;
            case 'checked_categories':
                $this->post->categories()->detach();
                $this->post->categories()->attach($this->checked_categories);
                break ;
        }
        if (!$this->post->status('published'))
            $this->post->save();
    }

    public function setStatus($status)
    {
        $status_id = array_search($status, Post::POST_STATUS);
        if ($status_id === false)
            return;
        if ($status != 'moderation' && $status != 'draft' && Auth::user()->role('user'))
            return;
        $this->post->status = $status_id;
        $this->post->save();
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.edit-post-page', compact('categories'));
    }
}
