<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Search extends Component
{
    public string $input = '';
    public string $class = '';

    public function render()
    {
        return view('livewire.search');
    }
}
