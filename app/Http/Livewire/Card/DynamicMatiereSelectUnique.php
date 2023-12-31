<?php 
// app/Http/Livewire/DynamicMatiereSelect.php

namespace App\Http\Livewire\Card;

use Livewire\Component;
use App\Models\CardLevel;
use App\Models\Matiere;
use App\Models\Formation;
use App\Models\User;
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
    public $cardLevels;
    public $cardLevelId;
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
        if(auth()->user()->hasRole('enseignant')) {
            if ($formation) {
                $user = auth()->user();
                $userMatieres = $user->matieres()->get();

                // Turn the matieres of the formation into a collection
                $formation = Formation::with('matieres')->find($this->selectedFormation);
                $formationMatieres = $formation->matieres;
            
                // find the common matieres between the user and the formation
                $commonMatieres = $userMatieres->intersect($formationMatieres);

                //Set the matieres to the matieres of the formation
                $this->matieres = $commonMatieres;
            } else {
                $this->matieres = [];
            }
        } else {
            if ($formation) {
                $this->matieres = $formation->matieres;
            } else {
                $this->matieres = [];
            }
        }
    }


    public function mount($matiereId, $chapitreId, $formationId, $card, $cardLevels ,$cardLevelId)
    {
        $this->cardLevels = $cardLevels;
        $this->cardLevelId = $cardLevelId;
        $this->selectedFormation = $formationId;

        $this->card = $card;
        $formation = Formation::with('matieres')->find($this->selectedFormation);
        //Set the matieres to the matieres of the formation
        if ($formation) {
            $this->matieres = $formation->matieres;
        } else {
            $this->matieres = [];
        }

        $this->selectedMatiere = $matiereId;
        //Catch all Matiere with chapitre and wich have the selected id matiere
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
        if(auth()->user()->hasRole('admin')) {
            $this->formations = Formation::all();
            
        } elseif( auth()->user()->hasRole('enseignant')) {
            $this->formations = Formation::all();
         
        } else {
            $this->matieres = $formation->formation_matiere()->wherePivot('formation_id', $user->formation_id)->get();
            $this->matieres->each(function ($matiere) {
                $matiere->chapitres = $matiere->chapitres()->pluck('label', 'id');
            });

        }
    
        $cardLevels =  CardLevel::all(); 
        $this->semestres = CardSemestre::all();
      

        
        return view('livewire.card.dynamic-matiere-select-unique');
    }

 
}
