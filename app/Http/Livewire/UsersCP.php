<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersCP extends Component
{
    public string   $orderBy = 'id';
    public string   $search = '';
    public int      $filter = -1;
    public bool     $asc = false;
    public int      $paginate = 20;

    public function render()
    {
        $users = User::select( 'role', 'avatar', 'id', 'name', 'nickname')
                ->orderBy($this->orderBy, $this->asc ? 'asc' : 'desc');
        if ($this->filter != -1)
            $users->where('role', $this->filter);
        if ($this->search != '')
            $users
                ->where('name', 'ILIKE', '%'.$this->search.'%')
                ->orWhere('nickname', 'ILIKE', '%'.$this->search.'%');
        $users = $users->paginate($this->paginate);
        $filters = [-1 => __('все')] + User::USER_ROLES;
        return view('livewire.dashboard.users-cp', compact('users', 'filters'));
    }
}
