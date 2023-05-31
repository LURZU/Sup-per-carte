<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index() {
        $matieres = Matiere::all();
        foreach( $matieres as $matiere) 
        {   
                $matiere->formations = $matiere->formations()->get();
        }
        

        return view('admin.matiere.index', ['matieres' => $matieres]);
    }

    public function create()
    {
        return view('matieres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
        ]);

        Matiere::create($request->all());

        return redirect()->route('matieres.index')->with('success', 'Matiere created successfully.');
    }

    public function edit(Matiere $matiere)
    {
        return view('matieres.edit', compact('matiere'));
    }

    public function update(Request $request, Matiere $matiere)
    {
        $request->validate([
            'label' => 'required',
        ]);

        $matiere->update($request->all());

        return redirect()->route('matieres.index')->with('success', 'Matiere updated successfully.');
    }

    public function destroy(Matiere $matiere)
    {
        $matiere->delete();

        return redirect()->route('matieres.index')->with('success', 'Matiere deleted successfully.');
    }
}
