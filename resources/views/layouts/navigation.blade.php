<div class="sidebar-container h-100 bg-dark text-decoration-none" style="height: 100vh!important; " id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="d-flex justify-content-center align-items-center mt-3">
            <img src="{{ asset('image/SuP-Perform-logo.svg') }}" class="mt-4 ms-2 px-4 reduce-mobile">
        </div>

        <div class="list-group list-group-flush px-2 p-2 fs-5 pt-5 text-decoration-none">

            <x-menu.menu-link route="dashboard" active="active_dashboard" icon="home  white-icon" label="SUP'PER CARTE" class="mb-4 mb-md-5" />

            <x-menu.menu-link route="dashboard" active="active_dashboard" icon="table-cells-large white-icon" label="Tableau de bord" class="text-uppercase"/>

            <x-menu.menu-link route="parameters" active="active_parameters" icon="gear white-icon" label="Paramètres" />

            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('etudiant'))
            <x-menu.menu-link route="stats.index" active="active_stats" icon="chart-pie white-icon" label="Statistiques {{ auth()->user()->hasRole('admin') ? 'étudiant' : '' }}" />
            @endif

            <x-menu.menu-link route="card.index" active="active_card" icon="clipboard-list white-icon" label="Cartes crées" />

            @if(auth()->user()->hasRole('etudiant'))
            <x-menu.menu-link route="card.favcard" active="active_favcard" icon="heart white-icon" label="Cartes préférées" />
            @endif

            @if(auth()->user()->hasRole('admin'))
            <x-menu.menu-link route="admin.profil.index" active="active_profil" icon="user-plus white-icon" label="Profils étudiant, Enseignants" />
            @endif


        </div>

        <div class="d-flex justify-content-center align-items-center my-3" >

                <a class="btn btn-primary bg-white text-dark border-0 w-100 mx-3 py-3" href="{{route('card.create')}}">Créer une carte<i class="fas fa-plus-circle ms-2 "></i></a>
        </div>
        <div class="mt-3">
            <form action="{{ route('logout') }}" method="POST" >
                @csrf
                @method('POST')
                <div class="d-flex justify-content-center">
                    <button type="submit"  class="text-white text-center fs-5 text-decoration-none border-0" style="background-color: transparent;"><i class="fa-solid fa-power-off  mx-auto  w-100"></i><p class="text-center">Déconnexion</p></button>
                </div>
            </form>
            <div class="d-flex justify-content-center mt-auto mb-2 fs-3 text-white">
                <a href="#" class="text-white me-2"><i class="fab fa-instagram "></i></a>
                <a href="#" class="text-white ms-2"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->
</div>
