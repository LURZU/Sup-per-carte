<?php 
// app/Http/Livewire/DynamicMatiereSelection.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CardLevel;
use App\Models\Matiere;
use App\Models\Formation;


class DynamicMatiereSelect extends Component
{
    public $formation;
    public $selectedMatiere;
    public $cardLevels = [];
    public $matiere_id;
    public $chapitre_id;
    public $matieres;
    public $chapitres;

    public function render()
    {
        $user = auth()->user();
        $formation = Formation::find($user->formation_id);
        $this->matieres = $formation->formation_matiere;
    
        return view('livewire.dynamic-matiere-select', [
            'matieres' => $this->matieres,
            'chapitres' => $this->getMaxChapitres()
        ]);
    }
    
    public function getMaxChapitres()
    {
        $maxChapitres = 0;
    
        foreach ($this->matieres as $matiere) {
            if ($matiere->number_chapitre > $maxChapitres) {
                $maxChapitres = $matiere->number_chapitre;
            }
        }
    
        return $maxChapitres;
    }
    

    public function updatedMatiereId()
    {
        $this->emit('matiereUpdated');
    }

    public function updateChapitres()
    {   
        $matiere = Matiere::find($this->selectedMatiere);

        if ($matiere) {
            foreach($matiere as $mat) {
                $this->chapitres = $mat->number_chapitre;
            }
        } else {
            $this->chapitres = null;
        }
    }

    public function getChapitres($matiereId)
    {
        $matiere = Matiere::find($matiereId);
        foreach($matiere as $mat){
            return $mat->number_chapitre;
        }
    }
    


    public function loadChapitres()
    {
        if ($this->matiere_id) {
            $matiere = Matiere::find($this->matiere_id);
            $this->chapitres = $matiere->chapitres()->pluck('label', 'id')->toArray();
        } else {
            $this->chapitres = [];
        }
    }
}
