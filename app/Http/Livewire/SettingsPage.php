<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SettingsPage extends Component
{

    public function render()
    {
        $categories = Auth::user()->interests();

        $user = Auth::user();
        return view('livewire.settings-page', compact('user', 'categories'))
            ->extends('layouts.base')
            ->section('content');
    }
}
