<?php 
// app/Http/Livewire/DynamicMatiereSelect.php

namespace App\Http\Livewire\Programme;

use Livewire\Component;
use App\Models\CardLevel;
use App\Models\Matiere;
use App\Models\Formation;
use App\Models\CardSemestre;


class DynamicMatiereSelect extends Component
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
        $matieres = Matiere::with('chapitres')->find($this->selectedMatiere);
        
        if ($matieres) {
            foreach($matieres as $matiere){
                $this->chapitres = $matiere->chapitres->pluck('label', 'id')->toArray();
            }
        } else {
            $this->chapitres = [];
        }
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
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('enseignant')) {
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
      

        
        return view('livewire.programme.dynamic-matiere-select');
    }
}
