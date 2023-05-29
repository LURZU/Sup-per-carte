<?php

namespace App\Http\Controllers\Programme;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Matiere;
use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\User;
use App\Models\CardLevel;
use App\Http\Requests\CardRequest;
use App\Http\Requests\QuizzSelectRequest;
use App\Models\Card;
use App\Models\StatusCard;

class ProgrammeQuotidienController extends Controller
{
    public function selectParameters(): View | RedirectResponse{
        if(auth()->user()->hasRole('prof') || auth()->user()->hasRole('admin')) {
            return redirect()->route('card.profcard');
        }
        $user = auth()->user();
        $cardLevels =  CardLevel::all();

        return  view('student.programme.select', [
            'cardLevels' => $cardLevels,
            ]);
    }

    public function startProgram(QuizzSelectRequest $request): View {
        if (auth()->user()->hasRole('student')) {
            $user = auth()->user();
            $cards = Card::where('matiere_id', $request->input('matiere_id'))->get();
            $card = new Card();
            $chapitre = new Chapitre();
            $cardLevels = new CardLevel();
            $matiere = new Matiere();
            $allStatusCards = $user->card_status_user;
            $list_of_all_card = $user->getCardStatus($allStatusCards, $user->id);
            $list_of_all_card = $card->getUnMasterCard($list_of_all_card);
            $cards_without_status = $card->getCardsWithoutStatus($cards);
            $collection1 = collect($list_of_all_card);
            $collection2 = collect($cards_without_status);
            $mergedCards = $collection1->concat($collection2);
            //Assign all of the value to the card 
            $mergedCards = $chapitre->getChapitre($mergedCards);
            $mergedCards = $cardLevels->getLevel($mergedCards);
            $mergedCards = $matiere->getMatiere($mergedCards);
            $mergedCards = $card->getPublicCard($mergedCards);

            return view('student.programme.quizzProgrammeQuotidien', [
                'cards' => $mergedCards,
                'cards_without_status' => $cards_without_status,
                'list_of_all_card' => $list_of_all_card,
            ]);
        }
    }
}
