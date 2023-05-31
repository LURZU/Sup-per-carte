@extends('prof.base')

@section('title', "Sup'Per Carte - Gestion des chapitres par matières")

@section('content')
    <H1>Chapitre</H1>
    @livewire('prof.chapitre-list', ['chapitres' => $chapitres, 'matiere_name' => $matiere_name, 'matiereId' => $matiereId])
@endsection