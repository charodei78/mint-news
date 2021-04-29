<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use function Couchbase\defaultDecoder;
use function Livewire\str;


class EditPostPage extends Component
{
    use WithFileUploads;

    public Post     $post;
    public array    $checked_categories = [];
    public          $preview;
    public          $postId = 0;

    protected array $rules = [
        'post.title' => 'required|min:20|max:80',
        'post.preview' => 'image',
        'post.synopsis' => 'required|min:20|max:160',
        'post.body' => 'required|min:400|max:16000',
    ];

    public function mount()
    {
        $post = Post::find($this->postId);
//        dd($this->postId);
        if ($post == null){
            $post = new Post;
            $post->user_id = Auth::user()->id;
            $post->title = "";
            $post->preview = "";
            $post->synopsis = "";
            $post->body = "";
            $post->status = 0;
        }
        if ($post->user_id != Auth::user()->id)
            abort(403);
        $this->post = $post;
        $this->post->save();
    }

    public function updated($name, $value)
    {
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
            case 'categories':
                $this->post->categories()->detach();
                $this->post->categories()->attach($this->categories);
                break ;
        }
        $this->post->save();
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.edit-post-page', compact('categories'));
    }
}
