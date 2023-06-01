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
            $formationLabels = $matiere->formations->pluck('label')->toArray();
            $matiere->formationLabels = $formationLabels;
        }
        return view('admin.matiere.create', ['matieres' => new Matiere()]);
    }

    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'label' => 'required',
    //     ]);

    //     Matiere::create($request->all());

    //     return redirect()->route('matieres.index')->with('success', 'Matiere created successfully.');
    // }

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

        return redirect()->route('admin.matiere.index')->with('success', 'Matiere updated successfully.');
    }

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
