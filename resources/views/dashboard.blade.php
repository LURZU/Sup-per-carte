<x-app-layout>
    @section('active_dashboard', 'active')
     @if(session('success'))
     <div class="alert alert-success">{{ session('success') }}</div>
     @endif
 
     @if(session('error'))
     <div class="alert alert-danger">{{ session('error') }}</div>
     @endif

    <div class="py-12 w-100">
        <div class="row">
            <div class="col-6">
                @if(auth()->user()->hasRole('admin'))
                <ul class="list-group text-center d-flex flex-row">
                    <li class="list-group-item row w-50">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('parameters')}}">Paramètres</a></div>
                    </li>
                    <li class="list-group-item row w-50">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('parameters')}}">Statistiques étudiant</a></div>
                    </li>
                    <li class="list-group-item row">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('card.index')}}">Carte crées</a></div>
                    </li>
                    <li class="list-group-item row">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('admin.profil.index')}}">Profils étudiant, Enseignant</a></div>
                    </li>
                    <!-- Repeat for each list item -->
                </ul>
                @elseif(auth()->user()->hasRole('student'))
                <ul class="list-group text-center">
                    <li class="list-group-item row">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('parameters')}}">Paramètres</a></div>
                    </li>
                    <li class="list-group-item row">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('parameters')}}">Mes statistiques</a></div>
                    </li>
                    <li class="list-group-item row">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('card.private')}}">Carte crées</a></div>
                    </li>
                    <li class="list-group-item row">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('admin.favcard')}}">Carte préférées</a></div>
                    </li>
                    <!-- Repeat for each list item -->
                </ul>
                @elseif(auth()->user()->hasRole('prof'))
                <ul class="list-group text-center">
                    <li class="list-group-item row">
                        <div class="col-6"><i class="fa fa-cog"></i></div>
                        <div class="col-6"><a href="{{route('parameters')}}">Paramètres</a></div>
                    </li>
                    <!-- Repeat for each list item -->
                </ul>
                @endif
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <i class="fa fa-plus-circle fa-3x"></i>
                    <a href="{{ route('card.create') }}" class="d-block">Créer une carte</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
