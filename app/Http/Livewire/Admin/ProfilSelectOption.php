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
    public $selectedMatiere;
    public $user;
    public $schools;
    public $formations;
    public $roles;
    public $matieresTab;
    public $matieres;
    public $formationId;
    public $matiereId;
    public $schoolId;
    public $firstname;
    public $lastname;
    public $email;


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

    public function mount($user, $matieresTab) {
        $this->user = $user;
        $this->firstname = $user->first_name;
        $this->lastname = $user->last_name;
        $this->email = $user->email;
        $this->schoolId = $user->school_id;
        $this->formationId = $user->formation_id;
        //Array of matiere_id
        $this->matiereId = $matieresTab;
        if(isset($user->roles()->first()->id)){
            $this->selectedTypeProfil = $user->roles()->first()->id;
        }
    }

    public function redirect_index() {
        return redirect()->route('admin.profil.index');
    }

    public function render()
    {
        //Init all value for profil form
        $list_roles = Roles::all();
        
        $this->schools = Schools::all();
        $this->formations = Formation::all();
        $this->matieres = Matiere::all();
        // foreach for on all role in bdd and add in table list_roles
        $this->roles = [];
        foreach($list_roles as $role){
            if( $role->name === 'enseignant') {
                $role->name = 'Enseignant';
                $this->roles[] =  $role;
                
            } else if($role->name === 'etudiant') {
                $role->name = 'Etudiant';
                $this->roles[] =  $role;
            }
        }

        return view('livewire.admin.profil-select-option');
    }

   
}
