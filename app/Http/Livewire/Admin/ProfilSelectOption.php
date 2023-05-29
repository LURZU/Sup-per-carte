<?php

namespace App\Http\Livewire\Admin;

use App\Models\Roles;
use App\Models\User;
use App\Models\Schools;
use App\Models\Formation;
use App\Models\Matiere;

use Livewire\Component;

class ProfilSelectOption extends Component
{

    public $selectedTypeProfil = 2;
    public $selectedSchool;
    public $selectedFormation;
    public $user;
    public $schools;
    public $formations;
    public $roles;
    public $matieres;


    public function updateFormOption() {
        //Can update the school_id and formation_id of the user
        $selectedRoleId = (int) $this->selectedTypeProfil;
        $selectedRole = null;
        // $role is table and not a collection it's why we use foreach
        foreach ($this->roles as $role) {
            if ($selectedRoleId === $role['id']) {
                $selectedRole = $role;
            }
        }

       
        
    }

    public function render()
    {
        //Init all value for profil form
        $list_roles = Roles::all();
        $this->user = new User();
        $this->schools = Schools::all();
        $this->formations = Formation::all();
        $this->matieres = Matiere::all();
        // foreach for on all role in bdd and add in table list_roles
        $this->roles = [];
        foreach($list_roles as $role){
            if( $role->name === 'prof') {
                $role->name = 'Enseignant';
                $this->roles[] =  $role;
                
            } else if($role->name === 'student') {
                $role->name = 'Etudiant';
                $this->roles[] =  $role;
            }
        }

        $user = new User();
        return view('livewire.admin.profil-select-option');
    }

   
}
