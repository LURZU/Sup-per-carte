<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Matiere;

class FilterProfil extends Component
{

    public $users;
    public $search = '';
    public $role = 'all';
    public $originalUsers;
    public $sorting = 'default';
    public $matiere = [];

    public function mount($users_role)
    {
        $this->originalUsers = $users_role;
        $this->users = $users_role;
        foreach($this->users as $user) {
            // take all matieres for enseignant
            if($user->role_name === 'enseignant') {
                $user->getMatiereListAttribute($user);
            }
        }
    }
    
    public function AssignMatiere() {

    }
    
    public function updatedRole()
    {
        $this->applyFilters();
    }
    
    public function updatedSearch()
    {
        $this->applyFilters();
    }

    public function updatedSorting()
    {
        $this->applyFilters();
    }
    
    public function applyFilters()
    {
        $user = new User();
        $this->originalUsers = $user->getRoles($this->originalUsers);
        $this->originalUsers = $user->getFormation($this->originalUsers);
        $users = collect($this->originalUsers);
    
        if ($this->search) {
            $users = $users->filter(function ($user) {
                return stripos($user->name, $this->search) !== false;
            });
        }
    
        if ($this->role !== 'all') {
            $users = $users->filter(function ($user) {
                return $user->role_name === $this->role;
            });
        }
    
        switch($this->sorting) {
            case 'date_desc':
                $users = $users->sortByDesc('created_at');
                break;
            case 'date_asc':
                $users = $users->sortBy('created_at');
                break;
            case 'name_az':
                $users = $users->sortBy('name');
                break;
            case 'name_za':
                $users = $users->sortByDesc('name');
                break;
        
        }
    

        $this->users = $users->values()->all();
        foreach($this->users as $user) {
            // take all matieres for enseignant
            if($user->role_name === 'enseignant') {
                $user->getMatiereListAttribute($user);
            }
        }

    }
    
    
    public function render()
    {
        
        return view('livewire.admin.filter-profil', [
            'users' => $this->users,
        ]);
    }
    
    
}
