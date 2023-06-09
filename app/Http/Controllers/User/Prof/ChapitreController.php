<?php

namespace App\Http\Controllers\User\Prof;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chapitre;
use App\Models\Matiere;

use Livewire\WithPagination;

class ChapitreController extends Controller
{
    use WithPagination;

    public function index()
    {
        if(auth()->user()->hasRole('enseignant')) {
            $matiere = User::find(auth()->user()->id)->matiere_id;
            $matiere_name = Matiere::where('id', $matiere)->first()->label;
            $chapitre = new Chapitre();
            $chapitres = $chapitre->getChapitresByMatiere($matiere);
            return view('prof.chapitre', ['chapitres' => $chapitres, 'matiere_name' => $matiere_name, 'matiereId'=>$matiere])
                ->extends('prof.base')
                ->section('content')
                ->layoutData(['title' => 'Liste des chapitres']);
        } else {
            return redirect()->route('dashboard');
        }
    }
}

