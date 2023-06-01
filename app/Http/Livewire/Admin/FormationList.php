<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Formation;
use App\Models\Matiere;
use App\Models\Card;
use App\Models\User;

class FormationList extends Component
{
    public $formations;
    public $matieres;
    public $matiere_name;
    public $editingFormation = false;
    public $label;
    public $formationId;
    public $matiereId;
    public $matiereIds;
    public $newFormation = false;
    public $newFormationLabel;
    public $matiere;
    protected $rules = [
        'matieres' => 'array',
        'matiereId' => 'integer',
        'matiere.id' => 'array',
        'matiereIds' => 'array'
    ];

    public function mount($formations)
    {
        $this->formations = $formations;
        $this->matiere = new Matiere();
        $this->matieres = Matiere::all();
    }

    public function addFormation()
    {
        $this->matiereIds = [];
        $this->newFormation = true;
    }

    public function createFormation()
    {
        $formation = new Formation();
        $formation->label = $this->newFormationLabel;
        $formation->save();
        $formation->matieres()->sync($this->matiereIds);
        // Refresh the list of formations
        $this->formations = Formation::all();
        
        $this->newFormation = false;
        $this->newFormationLabel = '';
        $this->formations = Formation::all();
    }

    public function cancelEditFormation()
    {
        $this->editingFormation = false;
    }

    public function cancelCreateFormation()
    {
        $this->newFormation = false;
        $this->newFormationLabel = '';
    }

    public function editFormation($formationId)
    {
        $this->matiereIds = $this->formations->find($formationId)->matieres()->pluck('id')->toArray();
        $this->formationId = $formationId;
        $formation = Formation::find($formationId);
        if ($formation) {
            $this->label = $formation->label;
            $this->editingFormation = true;
        }
    }

    public function updateFormation()
    {
        $formation = Formation::find($this->formationId);
        
        if ($formation) {
            $formation->label = $this->label;
            $formation->matieres()->detach();
            $formation->matieres()->sync($this->matiereIds);
            $formation->save();
            $this->editingFormation = false;
        }

        // Refresh the list of formations
        $this->formations = Formation::all();
    }

    public function deleteFormation($formationId)
    {
        $formation = Formation::find($formationId);
        if ($formation) {
            $users = User::where('formation_id', $formationId)->get();
            //Assign all users which have this formation to formation 3 (Non assigné)
            foreach ($users as $user) {
                $user->formation_id = 3;
                $user->save();
            }
            $formation->matieres()->detach();

            $formation->delete();

            // Refresh all data
            $this->formations = Formation::all();
        }
    }

    public function render()
    {
        return view('livewire.admin.formation-list');
    }
}
