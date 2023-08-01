<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matiere;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MatiereController extends Controller
{
    public function index(): View {
        $matieres = Matiere::with('formations')->get();
        foreach($matieres as $matiere) {
            $formationLabels = $matiere->formations->pluck('label')->toArray();
            $matiere->formationLabels = $formationLabels;
        }
        return view('admin.matiere.index', ['matieres' => $matieres]);
    }

    public function create(): View
    {
        $matieres = Matiere::with('formations')->get();
        foreach($matieres as $matiere) {
            // get all label of matiere's formations
            $formationLabels = $matiere->formations->pluck('label')->toArray();
            $matiere->formationLabels = $formationLabels;
        }
        return view('admin.matiere.create', ['matieres' => new Matiere()]);
    }

    public function edit(Matiere $matiere): View
    {
        return view('admin.matiere.edit', ['matieres' => $matiere]);
    }

    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'label' => 'required',
        ]);

        $matiere->update($request->all());

        return redirect()->route('admin.matiere.index')->with('success', 'Mise à jour de la matière.');
    }


    //Catch all relation of matiere and detach them of it (except chapitre who will be redefined to "Chapitre Non assigné")
    public function destroy(Matiere $matiere)
    {
        $matiere->formations()->detach();
    
        $cards = Card::where('matiere_id', $matiere->id)->get();

        // Redefine the card_chapitre_id of the cards to the chapitre "Chapitre Non assigné"
        $matiereNonAssigné = Matiere::where('label', 'Non assigné')->first();
            
        if ($matiereNonAssigné) {
            $cards->each(function ($carte) use ($matiereNonAssigné) {
                $carte->matiere_id = $matiereNonAssigné->id;
                $carte->save();
            });
        } else {
            // Create the chapitre "Chapitre Non assigné" if it doesn't exist
            $matiereNonAssigné = Matiere::create(['label' => 'Non assigné', 'number_chapitre' => 0]);
            $cards->each(function ($carte) use ($matiereNonAssigné) {
                $carte->matiere_id = $matiereNonAssigné->id;
                $carte->save();
            });
        }
        $matiere->chapitres()->delete();

        $matiere->delete();

        return redirect()->route('admin.matiere.index')->with('success', 'Matiere deleted successfully.');
    }
}
