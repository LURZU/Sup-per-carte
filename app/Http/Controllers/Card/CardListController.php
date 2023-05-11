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
class CardListController extends Controller
{
    public function showMyCard() {
        $user = User::find(auth()->id());
        if (auth()->user()->hasRole('admin')) {
            // Display all users
            $users = User::where('id', auth()->id())->get();
        } else {
            // Display only current user
            $users = User::where('id', auth()->id())->get();
        }
        $list_card_all = Card::where('created_by', $user->name)->get();
        $level = new CardLevel();
        $matiere = new Matiere();
        $list_card_all = $level->getLevel($list_card_all);
        $list_card_all =  $matiere->getMatiere($list_card_all);

        foreach($list_card_all as $card) {

        }

        return view('student.card.mycard', compact('users', 'list_card_all'));
    }
}
