<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Card;
use App\Models\CardLevel;
use App\Http\Requests\CardRequest;
use App\Models\Matiere;
use App\Models\Chapitre;
use App\Models\Formation;
use App\Models\CardSemestre; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CardController extends Controller
{


    //function to create card with value of level, semestre and matiere send in the view
    public function create(): View {
        $user = auth()->user();
        $card = new Card();
        $cardLevels = CardLevel::all();
        $semestres = CardSemestre::all();
     
        //formation and matieres is define in livewire component DynamicMatiereSelectUnique for card create
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('prof')) { 
            $allUser = User::all();
            $formations = Formation::all(); 
            // MANQUE CONDITION SI PROF ALORS SELECTIONNER UNE MATIERE PAR DEFAUT
            return view('student.card.create', ['user' => $user,'formations' => $formations, 'allUser' => $allUser, 'card' => $card, 'cardLevels' => $cardLevels, 'semestres' => $semestres, 'matiereId' => null, 'chapitreId' => null, 'formationId' => null]);
        } else if(auth()->user()->hasRole('student')) {
            return view('student.card.create', ['user' => $user, 'card' => $card, 'cardLevels' => $cardLevels, 'semestres' => $semestres, 'matiereId' => null, 'chapitreId' => null,  'formationId' => null]);
        }
    }

    //function to store card in the database information wich has upadate or create
    public function store(CardRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $card = new Card($data);
        //set the value of created_by and user_id if admin is the connected user
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('prof')) {
            if(is_array($request->input('created_by'))){
                $parts = explode(':', $request->input('created_by'));
                $id = $parts[1];
                $name = $parts[0];
            } else {
                $id = auth()->id();
                $name = auth()->user()->name;
            }
            $card->created_by = $name;
            $card->user_id = $id;
            $card->formation_id = $request->input('formation_id');
            $card->public = true;
            $card->validated_by = User::find(auth()->id())->name;
        } else {
            $card->formation_id = User::find(auth()->id())->formation_id;
            $card->created_by = User::find(auth()->id())->name;
            $card->user_id = User::find(auth()->id())->id;
            $card->public = false;
            $card->validated_by = null;
        }
        $card->save();
        return redirect()->route('card.index')->with('success', 'Carte créée avec succès.');
    }    

    //update all of validated request value + change the Created By if admin is the connected user
    public function update(CardRequest $request, Card $card) 
    {
        $data = $request->validated();
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('prof')) {
            if(is_array($request->input('created_by'))){
                $parts = explode(':', $request->input('created_by'));
                $id = $parts[1];
                $name = $parts[0];
                
            } else {
                $id = auth()->id();
                $name = auth()->user()->name;
            }
            $card->formation_id = $request->input('formation_id');
            $card->created_by = $name;
            $card->user_id = $id;
        } 
        $card->update($data);
    
        return redirect()->route('card.index');
    }
    

    public function edit(Card $card): View | RedirectResponse{
        if(auth()->user()->hasRole('student') && $card->user_id != auth()->id()) {
            return redirect()->route('card.index');
        } 
        

        return view('student.card.edit', [
            'user' => User::where('id', $card->user_id)->first(),
            'card' => $card,
            'matiereId' => $card->matiere_id,
            'chapitreId' => $card->card_chapitre_id,
            'formationId' => $card->formation_id,
            'cardLevels' => CardLevel::all(),
            'matieres' => Matiere::all(),
            'chapitres' => Chapitre::all(),
            'semestres' => CardSemestre::all(),
            'allUser' => User::all()
        ]);
    }

    public function destroy(Card $card): RedirectResponse
    {
        $card->delete();
        return redirect()->route('card.index');
    }
}
