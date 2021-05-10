<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Intervention\Image\ImageManager;
use Livewire\WithFileUploads;

class SettingsPage extends Component
{

    const AVATAR_SIZES = [
      'lg' => 256,
      'sm' => 128,
      'ico' => 64
    ];

    use WithFileUploads;

    public $avatar;
    public string $password = '';
    public string $passwordConfirmation = '';
    public string $oldPassword = '';
    public $user_id;

    protected $rules = [
        'password' => 'required|min:6',
    ];

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024|mimes:png,jpg', // 1MB Max
        ]);
    }

    public function updateAvatar() {
        $this->validate([
            'avatar' => 'image|max:1024|mimes:png,jpg', // 1MB Max
        ]);
        $user = $this->user;
        $path = 'public/user_avatars/'.$user->id;
        if (Storage::exists($path))
            Storage::deleteDirectory($path);
        Storage::makeDirectory($path);
        $manager = new ImageManager;
        $avatars = [];
        foreach (self::AVATAR_SIZES as $type => $size) {
            $image = $manager
                ->make($this->avatar->getRealPath())
                ->resize($size, $size)
                ->interlace()
                ->save('../storage/app/'.$path.'/'.$type.'.jpg', 90);
            $avatars[$type] = $path.'/'.$type.'.jpg';
        }
        $user->avatar = $avatars;
        $this->avatar = null;
        $user->save();
    }

    public function changePassword() {
        $this->resetErrorBag();
        if ($this->password != $this->passwordConfirmation) {
            $this->addError('password', 'Пароли не совпадают');
            return;
        }
        $this->validate();
        $user = $this->user;

        if (Auth::attempt(['email' => $user->email, 'password' => $this->oldPassword])) {
            $user->password = Hash::make($this->password);
            $user->save();
            session()->flash('message', 'Пароль успешно обновлен');
        }
        else {
            $this->addError('password', 'Не верный пароль');
        }
    }

    public function mount(int $id = 0)
    {
        if (!$id)
            $id = Auth::user()->id;
        $this->user_id = $id;
    }

    public function getUserProperty(): User
    {
        $user = User::find($this->user_id);
        if (!$user || Auth::user()->cannot('update', $user)) {
            $user = Auth::user();
        }
        return $user;
    }

    public function render()
    {
        $user = $this->user;
        $categories = $user->interests();

        return view('livewire.settings-page', compact('user', 'categories'))
            ->extends('layouts.base')
            ->section('content');
    }
}
