<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Chapitre;
use App\Models\Matiere;

//Gestion and chapitre in the same composant
class ChapitreSelectOption extends Component
{
    public $matiere;
    public $chapitres;
    public $label;
    public $rules = [
        'matiere.label' => 'required|unique:matiere,label', 
        'chapitres.*.label' => 'required',
    ];

    public function mount($matiere)
    {
        $this->matiere = $matiere;
        $this->label = $matiere->label;
        $this->chapitres = $matiere->chapitres()->get();
    }

    public function addChapitre()
    {
        $nouveauChapitre = new Chapitre();
        $nouveauChapitre->label = 'Nouveau chapitre'; 
        $nouveauChapitre->numero_chapitre = 0;// Add default value before it register
        $nouveauChapitre->save(); //Create a chapter in the databe to push it in the $this->chapitre
        $nouveauChapitre->matieres()->attach($this->matiere->id); 
        $this->chapitres->push($nouveauChapitre); 
    }
    

    public function removeChapitre($index)
    {
        // Supprimer le chapitre de la base de données
        if (isset($this->chapitres[$index])) {
            $chapitre = $this->chapitres[$index];
            if ($chapitre->id) {
                $chapitre->delete();
            }
        }

        // delete the chapitre from the array
        unset($this->chapitres[$index]);

        // refresh the array to reset the view livewire
        $this->chapitres = $this->chapitres->values();
    }

    

    public function save()
    {
        if ($this->matiere->id) {
            $this->matiere->update([
                'label' => $this->label,
            ]);
        } else {
            $this->matiere = Matiere::create([
                'label' => $this->label,
            ]);
        }

        foreach ($this->chapitres as $key => $chapitre) {
            if ($chapitre->id) {
                // Chapitre existant, up to date
                $chapitre->save();
            } else {
                // Nouveau chapitre, association à la matière et sauvegarde
                $chapitre->numero_chapitre = $key + 1;
                $this->matiere->chapitres()->save($chapitre);
            }
        }

        $this->matiere->refresh(); // Refresh data from relation
        $this->chapitres = $this->matiere->chapitres()->get();
        return redirect()->route('admin.matiere.index');
        session()->flash('success', 'Les chapitres ont été enregistrés.');
    }

    public function return() {
        return redirect()->route('admin.matiere.index');
    }

    public function render()
    {
        return view('livewire.admin.chapitre-select-option');
    }
}
