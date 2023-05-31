@extends('admin.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Dashboard</h2>
                <ul>
                    <li><a href="">Paramètres</a></li>
                    <li><a href="">Statistiques étudiant</a></li>
                    <li><a href="{{route('admin.formation.index')}}">Editer les formations</a></li>
                    <li><a href="{{ route('card.index')}}">Cartes créées</a></li>
                    <li><a href="{{ route('card.create')}}">Créer une carte</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Profils</h2>
                <ul>
                    <li><a href="{{route('admin.profil.index')}}">Profil étudiant/Enseignant/ ...</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
