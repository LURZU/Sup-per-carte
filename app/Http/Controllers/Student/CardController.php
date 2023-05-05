<?php

namespace App\Http\Controllers\Student;

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

class CardController extends Controller
{
    public function index() {
        // Check if user has permission
        if (auth()->user()->can('access_private_card')) {
            // Display all users
            $users = User::all();
        } else {
            // Display only current user
            $users = User::where('id', auth()->id())->get();
        }

        $list_card_all = Card::all();
     
        return view('student.card.index', compact('list_card_all'));
    }

    //function to show all card
    public function showAll() {
        $user = User::find(auth()->id());
       
        if (auth()->user()->hasRole('admin')) {
        // Display all users
        dd(auth()->user()->hasRole('admin'));
        } else {
            // Display only current user
            $users = User::where('id', auth()->id())->get();
        }
        $list_card_all = Card::all();
        $level = new CardLevel();
        $list_card_all = $level->getLevel($list_card_all);
        return view('student.card.index', compact('users', 'list_card_all'));
    }

    //function to create card with value of level, semestre and matiere send in the view
    public function create() {
        $cardLevels = CardLevel::all();
        $matieres = Matiere::all(); 
        $semestres = CardSemestre::all();
        return view('student.card.create', compact('cardLevels', 'matieres', 'semestres'));
    }

    public function show() {

    }

    //function to store card in the database information wich has upadate or create
    public function store(CardRequest $request) {
        $card = new Card();
        $card->question = $request->input('question');
        $card->response = $request->input('response');
        $card->card_level_id = $request->input('level');
        $card->card_semestre_id = $request->input('semestre');
        
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('professeur')) {
            $card->public = true;
        } else {
            $card->public = false;
        }
        // Assurez-vous d'ajuster le nom de la colonne dans la table si besoin.
    
        $card->save();
    
        return redirect()->route('card.index')->with('success', 'Carte créée avec succès.');
    }

    public function destroy() {

    }
}
