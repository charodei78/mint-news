<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsPage extends Component
{

    use WithFileUploads;

    public $photo;
    public string $password = '';
    public string $passwordConfirmation = '';
    public string $oldPassword = '';

    protected $rules = [
        'password' => 'required|min:6',
    ];

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function updateAvatar(Request $request) {
        $this->photo = $request->get('photo');
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
        $user = Auth::user();
        $path = 'public/user_avatars/'.$user->id;
        if (Storage::exists($path))
            Storage::deleteDirectory($path);
        Storage::makeDirectory($path);
        $user->avatar = $this->photo->store($path);
        $user->save();
    }

    public function changePassword() {
        $this->resetErrorBag();
        if ($this->password != $this->passwordConfirmation) {
            $this->addError('password', 'Пароли не совпадают');
            return;
        }
        $this->validate();
        $user = Auth::user();

        if (Auth::attempt(['email' => $user->email, 'password' => $this->oldPassword])) {
            $user->password = Hash::make($this->password);
            $user->save();
            session()->flash('message', 'Пароль успешно обновлен');
        }
        else {
            $this->addError('password', 'Не верный пароль');
        }
    }

    public function render()
    {
        $categories = Auth::user()->interests();

        $user = Auth::user();
        return view('livewire.settings-page', compact('user', 'categories'))
            ->extends('layouts.base')
            ->section('content');
    }
}
