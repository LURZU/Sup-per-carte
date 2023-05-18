<?php 
// app/Http/Livewire/DynamicMatiereSelect.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CardLevel;
use App\Models\Matiere;
use App\Models\Formation;
use App\Models\CardSemestre;

class DynamicMatiereSelectUnique extends Component
{
    public $formation;
    public $selectedMatiere;
    public $matiere_id;
    public $chapitre_id;
    public $chapitres = [];
    public $matieres = [];
    public $formations;
    public $selectedChapitre;
    public $selectedFormation;
    public $semestres;
    public $card;


    public function updateChapitres()
    {   
        //Find the selectedMatiere and get the chapitres assign to the id of the matiere
        $matiere = Matiere::with('chapitres')->find($this->selectedMatiere);
        
        if ($matiere) {
            $this->chapitres = $matiere->chapitres->pluck('label', 'id')->toArray();
        } else {
            $this->chapitres = [];
        }
    }

    public function updateMatieres()
    {   
         //Same as Chapitre but for Matiere
        $formation = Formation::with('matieres')->find($this->selectedFormation);
        
        if ($formation) {
            $this->matieres = $formation->matieres;
        } else {
            $this->matieres = [];
        }
    }


    public function mount($matiereId, $chapitreId, $formationId, $card)
    {
        $this->selectedFormation = $formationId;
        $this->card = $card;
        $formation = Formation::with('matieres')->find($this->selectedFormation);
        
        if ($formation) {
            $this->matieres = $formation->matieres;
        } else {
            $this->matieres = [];
        }

        $this->selectedMatiere = $matiereId;
  
        $matiere = Matiere::with('chapitres')->find($this->selectedMatiere);
        if ($matiere) {
            $this->chapitres = $matiere->chapitres->pluck('label', 'id')->toArray();
        } else {
            $this->chapitres = [];
        }
        $this->selectedChapitre = $chapitreId;
    }


    public function submitForm()
    {
        $this->redirect(route('card.edit', ['card' => $this->card, 'matiereId' => $this->selectedMatiere, 'chapitreId' => $this->selectedChapitre]));
    }


    public function render()
    {
        $user = auth()->user();
        //Take the formation_id of the user
        $formation = Formation::find($user->formation_id);
        //Contain all of "matiere" for the formation_id FOR STUDENT
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('prof')) {
            $this->formations = Formation::all();
            
        } else {
            $this->matieres = $formation->formation_matiere()->wherePivot('formation_id', $user->formation_id)->get();
            // Récupérer les chapitres pour chaque matière
            $this->matieres->each(function ($matiere) {
                $matiere->chapitres = $matiere->chapitres()->pluck('label', 'id');
            });
        }
    
        $cardLevels =  CardLevel::all(); 
        $this->semestres = CardSemestre::all();
      

        
        return view('livewire.dynamic-matiere-select-unique');
    }

 
}
