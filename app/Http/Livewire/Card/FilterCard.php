<?php

namespace App\Http\Livewire\Card;

use Livewire\Component;
use App\Models\Card;
use App\Models\CardLevel;
use App\Models\Matiere;
use App\Models\Chapitre;
use App\Models\Formation;

class FilterCard extends Component
{
    public $list_card_all;
    public $role = '';
    public $sorting = 'default';
    protected $listeners = ['applyFilters'];
    public $cards_save = [];
    public $formations = [];
    public $matieres = [];
    public $chapitres = [];
    public $niveaux = [];
    public $selectedFormations = [];
    public $selectedMatieres = [];
    public $selectedChapitres = [];
    public $selectedNiveaux = [];
    public $showDropdsown = false;
    public $showDropdown = false;

    public function mount($list_card_all) {
        $this->list_card_all = $list_card_all;
        $this->cards_save = $list_card_all;
        $this->formations = Formation::all();
        $this->matieres = Matiere::all();
        $this->chapitres = Chapitre::all();
        $this->niveaux = CardLevel::all();
    }

    //Pour toggle les sous dropdown
    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function render()
    {
        $level = new CardLevel();
        $matiere = new Matiere();
        $chapitre = new Chapitre();
        $this->list_card_all = $chapitre->getChapitre($this->list_card_all);
        $this->list_card_all = $level->getLevel($this->list_card_all);
        $this->list_card_all =  $matiere->getMatiere($this->list_card_all);
        //Apply role filter on card
        if (!empty($this->role)) {
            $this->list_card_all = $this->cards_save;
            $this->list_card_all = $this->setCardProperty($this->list_card_all);
            $this->appyFiltersWithoutRender($this->selectedFormations, $this->selectedMatieres, $this->selectedChapitres, $this->selectedNiveaux);
            if(!empty($this->list_card_all)) {
                //filter card by role define by model $this->role
                $this->list_card_all = $this->list_card_all->filter(function ($card) {
                    $user = $card->user;
                    return $user && $user->hasRole($this->role);
                });
            } else {
                $this->list_card_all = [];
            }

        } else if(!empty($this->selectedFormations) || !empty($this->selectedMatieres) || !empty($this->selectedChapitres) || !empty($this->selectedNiveaux)) {

        }

        if($this->role == 'default') {
            $this->list_card_all = $this->cards_save;
            $this->appyFiltersWithoutRender($this->selectedFormations, $this->selectedMatieres, $this->selectedChapitres, $this->selectedNiveaux);
            $this->list_card_all = $this->setCardProperty($this->list_card_all);
        }

        if($this->sorting === 'asc') {
            $this->list_card_all =  $this->list_card_all->sortBy('created_at');
        } elseif($this->sorting === 'desc') {
            $this->list_card_all =  $this->list_card_all->sortByDesc('created_at');
        } elseif($this->sorting === 'default'){
            $this->list_card_all =  $this->list_card_all->sortByDesc('created_at');
        }
//        dd($this->list_card_all);
        return view('livewire.card.filter-card', [
            'list_card_all' =>  $this->list_card_all,
            'formations' => Formation::all(),
            'matieres' => Matiere::all(),
            'chapitres' => Chapitre::all(),
            'niveaux' => CardLevel::all(),
        ]);
    }

    public function appyFiltersWithoutRender($selectedFormation, $selectedMatiere, $selectedChapitre , $selectedNiveau) {
        $this->list_card_all = $this->cards_save;
        $this->selectedFormations = $selectedFormation;
        $this->selectedMatieres = $selectedMatiere;
        $this->selectedChapitres = $selectedChapitre;
        $this->selectedNiveaux = $selectedNiveau;

        if(!empty($this->selectedFormations)) {
            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->formation_id, $this->selectedFormations);
            });
        }

        if(!empty($this->selectedMatieres)) {

            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->matiere_id, $this->selectedMatieres);
            });

        }

        if(!empty($this->selectedChapitres)) {
            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->chapitre_id, $this->selectedChapitres);
            });
        }

        if(!empty($this->selectedNiveaux)) {
            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->niveau_id, $this->selectedNiveaux);
            });
        }

    }

    public function applyFilters($selectedFormation, $selectedMatiere, $selectedChapitre , $selectedNiveau) {
        $this->list_card_all = $this->cards_save;
        $this->selectedFormations = $selectedFormation;
        $this->selectedMatieres = $selectedMatiere;
        $this->selectedChapitres = $selectedChapitre;
        $this->selectedNiveaux = $selectedNiveau;

        if(!empty($this->selectedFormations)) {
            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->formation_id, $this->selectedFormations);
            });
        }

        if(!empty($this->selectedMatieres)) {

            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->matiere_id, $this->selectedMatieres);
            });

        }

        if(!empty($this->selectedChapitres)) {
            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->chapitre_id, $this->selectedChapitres);
            });
        }

        if(!empty($this->selectedNiveaux)) {
            $this->list_card_all = $this->list_card_all->filter(function ($card) {
                return in_array($card->niveau_id, $this->selectedNiveaux);
            });
        }

        // Apply filter on the render
        $this->render();
    }



    //can redifine the matiere, chapter and level of card when filter is apply
    public function setCardProperty($filter) {
        $level = new CardLevel();
        $matiere = new Matiere();
        $chapitre = new Chapitre();

        $filter = $chapitre->getChapitre($filter);
        $filter = $level->getLevel($filter);
        $filter =  $matiere->getMatiere($filter);

        return $filter;
    }





    public function updated($propertyName)
    {
        $this->render();
    }
}
