<?php

namespace App\Http\Controllers\Programme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Matiere;
use App\Models\Formation;
use App\Models\User;
use App\Models\CardLevel;
use App\Http\Requests\CardRequest;
use App\Http\Requests\QuizzSelectRequest;
use App\Models\Card;
use App\Models\StatusCard;

class ProgrammeQuotidienController extends Controller
{
    public function selectParameters(): View {
        $user = auth()->user();
        $formation = Formation::find($user->formation_id);
        //Contain all of "matiere" for the formation_id
        $matieres = $formation->formation_matiere; 
        $cardLevels =  CardLevel::all();
        //For the number of "chapitre" matieres is an array

        return  view('student.programme.select', [
            'matieres' => $matieres,
            'cardLevels' => $cardLevels,
            ]);
    }

    public function startProgram(QuizzSelectRequest $request): View {
        if (auth()->user()->hasRole('student')) {
            $user = auth()->user();
            $cards = Card::where('matiere_id', $request->input('matiere_id'))->get();
            $allStatusCards = $user->card_status_user;
            
            foreach($allStatusCards as $card) {
                $card->user_id = $user->id;
                $card = $user->getCardStatus($card, $user->id);
            }
            return view('student.programme.quizzProgrammeQuotidien', [
            ]);
        }
    }
}
