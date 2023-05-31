<?php

namespace App\Http\Livewire\Prof;

use Livewire\Component;
use App\Models\Chapitre;
use App\Models\Matiere;
use App\Models\Card;

class ChapitreList extends Component
{
    public $chapitres;
    public $matiere_name;
    public $chapitreId;
    public $editingChapitre = false;
    public $label;
    public $newChapitre = false;
    public $matiereId; // from ChapitreController
    public $newChapitreLabel;

    public function mount($chapitres, $matiere_name, $matiereId)
    {
        $this->chapitres = $chapitres;
        $this->matiere_name = $matiere_name;
        $this->matiereId = $matiereId;
    }

    public function addChapitre()
    {
        $this->newChapitre = true;
    }

    public function createChapitre()
    {
        $chapitre = new Chapitre();
        $chapitre->label = $this->newChapitreLabel;
        $chapitre->numero_chapitre = 6;
        $chapitre->save();

        // Associate the new chapitre with the matiere
        $matiere = Matiere::find($this->matiereId);
        if ($matiere) {
            $matiere->chapitres()->attach($chapitre->id);
        }

        // Reset values
        $this->newChapitre = false;
        $this->newChapitreLabel = '';

        // Refresh the list of chapitres
        $chapitres = $chapitre->getChapitresByMatiere($this->matiereId);
        $this->chapitres = $chapitres;
    }


    public function cancelEditChapitre()
    {
        $this->editingChapitre = false;
    }

    public function editChapitre($chapitreId)
    {
        $this->chapitreId = $chapitreId;
        $chapitre = Chapitre::find($chapitreId);
        if ($chapitre) {
            $this->label = $chapitre->label;
            $this->editingChapitre = true;
        }
    }

    public function updateChapitre()
    {
        $chapitre = Chapitre::find($this->chapitreId);
        if ($chapitre) {
            $chapitre->label = $this->label;
            $chapitre->save();
            $this->editingChapitre = false;
        }
    }

    public function deleteChapitre($chapitreId)
    {
        $chapitre = Chapitre::find($chapitreId);
        
        if ($chapitre) {
            $cartes = Card::where('card_chapitre_id', $chapitre->id)->where('matiere_id', $this->matiereId)->get();

            // Redefine the card_chapitre_id of the cards to the chapitre "Chapitre Non assigné"
            $chapitreNonAssigné = Chapitre::where('label', 'Non assigné')->first();
            
            if ($chapitreNonAssigné) {
                $cartes->each(function ($carte) use ($chapitreNonAssigné) {
                    $carte->card_chapitre_id = $chapitreNonAssigné->id;
                    
                    $carte->save();
                });
        }
        //Detach the chapitre from the matiere
        $chapitre->matieres()->detach();
        $chapitre->delete();

        // Refresh the list of chapitres
        $chapitres = $chapitre->getChapitresByMatiere($this->matiereId);
        $this->chapitres = $chapitres;
    }
    }

    

   


    public function render()
    {
        return view('livewire.prof.chapitre-list');
    }
}
