<x-app-layout>
     @include('components.header')

    <div class="py-12">
        @if(auth()->user()->hasRole('admin'))
        <ul class="list-group">
            <li class="list-group-item"><a href="">Paramètres</a></li>
            <li class="list-group-item"><a href="">Statistiques étudiant</a></li>
            <li class="list-group-item"><a href="{{ route('admin.formation.index') }}">Editer les formations</a></li>
            <li class="list-group-item"><a href="{{ route('admin.matiere.index') }}">Editer les matières et les chapitres</a></li>
            <li class="list-group-item"><a href="{{ route('admin.profil.index') }}">Profil étudiant/Enseignant/...</a></li>
            <li class="list-group-item"><a href="{{ route('card.index') }}">Cartes créées</a></li>
            <li class="list-group-item"><a href="{{ route('card.create') }}">Créer une carte</a></li>
        </ul>
        @elseif(auth()->user()->hasRole('student'))
        <ul class="list-group">
            <li class="list-group-item"><a href="">Paramètres</a></li>
            <li class="list-group-item"><a href="">Mes statistiques</a></li>
            <li class="list-group-item"><a href="{{ route('card.private') }}">Cartes créées</a></li>           
            <li class="list-group-item"><a href="{{ route('card.favcard') }}">Mes cartes favorites</a></li>
            <li class="list-group-item"><a href="{{ route('card.create') }}">Créer une carte</a></li>
        </ul>
        @elseif(auth()->user()->hasRole('prof'))
        <p>Contenu spécifique pour les enseignants.</p>
        @endif
    </div>
</x-app-layout>
