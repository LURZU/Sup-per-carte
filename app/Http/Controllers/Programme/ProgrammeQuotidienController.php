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
        if(auth()->user()->hasRole('enseignant') || auth()->user()->hasRole('admin')) {
            return redirect()->route('card.profcard');
        }
        $user = auth()->user();
        $cardLevels =  CardLevel::all();

        return  view('student.programme.select', [
            'cardLevels' => $cardLevels,
            ]);
    }

    public function startProgram(QuizzSelectRequest $request): View {
        if (auth()->user()->hasRole('etudiant')) {
            $user = auth()->user();
            $cards = Card::where('matiere_id', $request->input('matiere_id'))->get();
            $card = new Card();
            $chapitre = new Chapitre();
            $cardLevels = new CardLevel();
            $matiere = new Matiere();
            $allStatusCards = $user->card_status_user;
            //asign status to the card
            $list_of_all_card = $user->getCardStatus($allStatusCards, $user->id);
            //get all of the card that are not master
            $list_of_all_card = $card->getUnMasterCard($list_of_all_card);
            //Get card without status and sort them by level
            $cards_without_status = $card->getCardsWithoutStatus($cards);
            //Merge the two collection
            $collection1 = collect($list_of_all_card);
            $collection2 = collect($cards_without_status);
            $mergedCards = $collection1->concat($collection2);
            //Assign all of the value to the card for the view  
            //Verify and return if card respond of all of the request return
            $mergedCards = $card->getCardRequest($mergedCards, $request);
  
            ////////////////////////////////////////////////////////////////
            $mergedCards = $chapitre->getChapitre($mergedCards);
            $mergedCards = $cardLevels->getLevel($mergedCards);
            $mergedCards = $matiere->getMatiere($mergedCards);
            $mergedCards = $card->getPublicCard($mergedCards);

            return view('student.programme.quizzProgrammeQuotidien', [
                'cards' => $mergedCards,
                'number_card' => $request->input('number_card'),
                'cards_without_status' => $cards_without_status,
                'list_of_all_card' => $list_of_all_card,
            ]);
        }
    }

    //Function to get all of card with no status, wich has public and 
    public function randomCard() {
        if (auth()->user()->hasRole('etudiant')) {
            $user = auth()->user();
            $cards = Card::all();
            $card = new Card();
            $chapitre = new Chapitre();
            $cardLevels = new CardLevel();
            $matiere = new Matiere();
            $allStatusCards = $user->card_status_user;
            //asign status to the card
            $list_of_all_card = $user->getCardStatus($allStatusCards, $user->id);
            //get all of the card that are not master
            $list_of_all_card = $card->getUnMasterCard($list_of_all_card);
            //Get card without status and sort them by level
            $cards_without_status = $card->getCardsWithoutStatus($cards);
            //Merge the two collection
            $collection1 = collect($list_of_all_card);
            $collection2 = collect($cards_without_status);
            $mergedCards = $collection1->concat($collection2);
         
            $mergedCards = $chapitre->getChapitre($mergedCards);
            $mergedCards = $cardLevels->getLevel($mergedCards);
            $mergedCards = $matiere->getMatiere($mergedCards);
            $mergedCards = $card->getPublicCard($mergedCards);

            return view('student.programme.unmastered-programme', [
                'cards' => $mergedCards,
                'number_card' => 10,
                'cards_without_status' => $cards_without_status,
                'list_of_all_card' => $list_of_all_card,
            ]);
        }
    }
}
