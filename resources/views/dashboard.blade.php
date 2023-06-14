<x-app-layout>
    @section('title', 'Dashboard')
    @section('active_dashboard', 'active')
     @if(session('success'))
     <div class="alert alert-success">{{ session('success') }}</div>
     @endif

     @if(session('error'))
     <div class="alert alert-danger">{{ session('error') }}</div>
     @endif

    <div class="d-flex flex-row flex-column flex-lg-row py-3">
        <div class="row mx-0 w-100">
            <div class="col-12 col-lg-8">
                <div class="row">
                    <x-buttons.dashboard-button link="parameters" icon="cog" label="Paramètres" class="col-lg-6" />

                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('etudiant'))
                    <x-buttons.dashboard-button link="stats.index" icon="chart-pie" label="Statistiques {{ auth()->user()->hasRole('admin') ? 'étudiant' : '' }}" class="col-lg-6" />
                    @endif

                    <x-buttons.dashboard-button link="card.index" icon="clipboard-list" label="Cartes crées" class="col-lg-6" />

                    @if(auth()->user()->hasRole('etudiant'))
                    <x-buttons.dashboard-button link="card.favcard" icon="clipboard-list" label="Cartes préférées" class="col-lg-6" />
                    @endif

                    @if(auth()->user()->hasRole('admin'))
                    <x-buttons.dashboard-button link="admin.profil.index" icon="user-plus" label="Profils étudiant, Enseignants" class="col-lg-6" />
                    @endif

                </div>
            </div>

            <div class="col-12 col-lg-4 px-0 px-lg-2">
                <x-buttons.dashboard-button link="card.index" icon="plus-circle" label="Créer une carte" class="col-lg-12 h-100 dashboard-col-2" />
            </div>

        </div>

    </div>

</x-app-layout>
