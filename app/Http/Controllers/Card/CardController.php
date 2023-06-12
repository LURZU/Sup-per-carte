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
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    //function to create card with value of level, semestre and matiere send in the view
    public function create(): View | RedirectResponse{
        //Verify if the number of public card is less than the number of public card in the deck of the admin
        if(User::find(1)->total_card_toshow > Card::where('public', true)->get()->count()) {
            $user = auth()->user();
            $card = new Card();
            $cardLevels = CardLevel::all();
            $semestres = CardSemestre::all();
         
            //formation and matieres is define in livewire component DynamicMatiereSelectUnique for card create
            if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('enseignant')) { 
                $allUser = User::all();
                $formations = Formation::all(); 
                
                return view('student.card.create', ['user' => $user,'formations' => $formations, 'allUser' => $allUser, 'card' => $card, 'cardLevels' => $cardLevels, 'semestres' => $semestres, 'matiereId' => null, 'chapitreId' => null, 'formationId' => null, 'cardLevelId' => null]);
            } else if(auth()->user()->hasRole('etudiant')) {
                return view('student.card.create', ['user' => $user, 'card' => $card, 'cardLevels' => $cardLevels, 'semestres' => $semestres, 'matiereId' => null, 'chapitreId' => auth()->user()->formation_id,  'formationId' => null, 'cardLevelId' => null]);
            }
        } else {
            return redirect()->route('dashboard')->with('error', 'Le nombre maximum de carte créer a été atteint, veuillez demander à l\'admin d\'augmenter la limite');
        }
       
    }

    //function to store card in the database information wich has upadate or create
    public function store(CardRequest $request): RedirectResponse
    {   
    
        $data = $request->validated();
        $card = new Card($data);
        //set the value of created_by and user_id if admin is the connected user
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('enseignant')) {
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
        } elseif(auth()->user()->hasRole('etudiant')) {
         
            $card->formation_id = User::find(auth()->id())->formation_id;
            $card->created_by = User::find(auth()->id())->name;
            $card->user_id = User::find(auth()->id())->id;
            $card->public = false;
            $card->validated_by = null;
        }
        if ($request->hasFile('question_img_url')) {
            $questionImagePath = $request->file('question_img_url')->store('img/card', 'public');
            $card->question_img_url = $questionImagePath;
        }
    
        if ($request->hasFile('response_img_url')) {
            $responseImagePath = $request->file('response_img_url')->store('img/card', 'public');
            $card->response_img_url = $responseImagePath;
        }
        $card->save();
        return redirect()->route('card.index')->with('success', 'Votre carte a été créée avec succès.');
    }    

    //update all of validated request value + change the Created By if admin is the connected user
    public function update(CardRequest $request, Card $card) 
    {
        $data = $request->validated();
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('enseignant')) {
            //split the name and the id of the request input
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
        if ($request->hasFile('question_img_url')) {
            // Delete the old image if it exists
            if ($card->question_img_url) {
                Storage::disk('public')->delete($card->question_img_url);
            }
        
            $questionImagePath = $request->file('question_img_url')->store('img/card', 'public');
            $card->question_img_url = $questionImagePath;
            unset($data['question_img_url']);  // Remove the key from the data array
        }
        
        if ($request->hasFile('response_img_url')) {
            // Delete the old image if it exists
            if ($card->response_img_url) {
                Storage::disk('public')->delete($card->response_img_url);
            }
        
            $responseImagePath = $request->file('response_img_url')->store('img/card', 'public');
            $card->response_img_url = $responseImagePath;
            unset($data['response_img_url']);  // Remove the key from the data array
        }
        
        $card->update($data);
        $card->save();
        
        
    
        return redirect()->route('card.index')->with('success', 'Votre carte a été modifiée avec succès.');
    }
    

    public function edit(Card $card): View | RedirectResponse{
        if(auth()->user()->hasRole('etudiant') && $card->user_id != auth()->id()) {
            return redirect()->route('card.index');
        } 
        

        return view('student.card.edit', [
            'user' => User::where('id', $card->user_id)->first(),
            'card' => $card,
            'matiereId' => $card->matiere_id,
            'chapitreId' => $card->card_chapitre_id,
            'formationId' => $card->formation_id,
            'cardLevelId' => $card->card_level_id,
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
