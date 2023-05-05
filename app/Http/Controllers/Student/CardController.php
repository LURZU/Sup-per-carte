<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Card;
use App\Models\CardLevel;


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


    public function showAll() {
        // Check if user has permission
        if (auth()->user()->can('access_private_card')) {
        // Display all users
        $users = User::all();
        } else {
            // Display only current user
            $users = User::where('id', auth()->id())->get();
        }

        $list_card_all = Card::all();
        $level = new CardLevel();
        $list_card_all = $level->getLevel($list_card_all);
        return view('student.card.index', compact('users', 'list_card_all'));
    }

    
    public function create() {
        return view('student.card.create');
    }

    public function show() {

    }

    public function store(Request $request) {
          // Check if user has permission
        if(auth()->user()) {
            $users = User::where('id', auth()->id())->get();
        } else {
           return view('layouts.error');
        }

        $request->validate([
            'question' => 'required|unique:card,question',
            'response' => 'required',
            'level' => 'required',
        ]);
    
        // Créer une nouvelle instance de modèle Card
        $card = new Card();
        $level = new CardLevel();
        // Remplir les propriétés du modèle avec les données du formulaire
        $card->question = $request->input('question');
        $card->response = $request->input('response');
        $card->card_level_id = $request->input('level');
        $card->card_semestre_id = $request->input('semestre');

        $user = auth()->id();

        if ($user->hasRole('admin') || $user->hasRole('prof')) {
            $card->public = true;
        } else {
            $card->public = false;
        }

        $card->level = $request->input('level');
    
        // Enregistrer le modèle dans la base de données
        $card->save();
    
        // Rediriger l'utilisateur vers la liste des cartes
        return redirect()->route('card.index')->with('success', 'Carte créée avec succès.');
    }
    

    public function destroy() {

    }
}
