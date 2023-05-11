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
use App\Models\CardSemestre; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CardController extends Controller
{

    //function to show all card
    public function showAll(): View {
        $user = User::find(auth()->id());
        if (auth()->user()->hasRole('admin')) {
            // Display all users
            $users = User::where('id', auth()->id())->get();
        } else {
            // Display only current user
            $users = User::where('id', auth()->id())->get();
        }
        $list_card_all = Card::all();
        $level = new CardLevel();
        $matiere = new Matiere();
        $list_card_all = $level->getLevel($list_card_all);
        $list_card_all =  $matiere->getMatiere($list_card_all);
        return view('student.card.index', compact('users', 'list_card_all'));
    }

    //function to create card with value of level, semestre and matiere send in the view
    public function create(): View {
        $card = new Card();
        $cardLevels = CardLevel::all();
        $matieres = Matiere::all(); 
        $semestres = CardSemestre::all();
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('prof')) { 
            $allUser = User::all();
            return view('student.card.create', ['allUser' => $allUser, 'card' => $card, 'cardLevels' => $cardLevels, 'matieres'=>$matieres, 'semestres' => $semestres]);
        } else {
            return view('student.card.create', ['card' => $card, 'cardLevels' => $cardLevels, 'matieres'=>$matieres, 'semestres' => $semestres]);
        }
    }

    //function to store card in the database information wich has upadate or create
    public function store(CardRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $card = new Card($data);
        // Appliquer true à "public" si l'utilisateur est admin ou prof
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('prof')) {
            $parts = explode(':', $request->input('created_by'));
            $id = $parts[1];
            $name = $parts[0];
            $card->created_by = $name;
            $card->user_id = $id;
            
            $card->public = true;
            $card->validated_by = User::find(auth()->id())->name;
        } else {
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
            $parts = explode(':', $request->input('created_by'));
            $id = $parts[1];
            $name = $parts[0];
            $card->created_by = $name;
            $card->user_id = $id;
        } 
        $card->update($data);
    
        return redirect()->route('card.index');
    }
    

    public function edit(Card $card): View {
        return view('student.card.edit', [
            'card' => $card,
            'cardLevels' => CardLevel::all(),
            'matieres' => Matiere::all(),
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
