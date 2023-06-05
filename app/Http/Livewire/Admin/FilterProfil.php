<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class FilterProfil extends Component
{

    public $users;

    public $search = '';

    public $category;

    public function mount($users_role)
    {
        $this->users = $users_role;
    }

    public function render()
    {
        $this->users = User::where('name', 'like', '%'.$this->search.'%')->get();

        if($this->category === 'all') {
            $this->users = $this->users->where('category', $this->category);
        }

        return view('livewire.admin.filter-profil', [
            'users' => $this->users
        ]);

    }
}
