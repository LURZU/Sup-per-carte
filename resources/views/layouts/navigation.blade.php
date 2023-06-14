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
<<<<<<< HEAD
        @if(auth()->user()->hasRole('admin'))
        
        <div class="list-group list-group-flush px-2 p-2 fs-5 pt-5 text-decoration-none">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase text-white mt-3 hover-bg my-4 @yield('active_dashboard')"><i class="fa-solid fa-house m-2"></i><span>{{ __('SUP\'PER CARTE') }}</span></a>
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase text-white hover-bg my-3"><i class="fa-solid fa-table-cells-large m-2"></i>{{ __('Tableau de bord') }}</a>
            <a href="{{ route('parameters') }}" class="text-decoration-none text-white @yield('active_parameters')"><i class="fa-solid fa-gear m-2 my-2 "></i>{{ __('Paramètres') }}</a>
            <a href="{{ route('admin.data') }}" class="text-decoration-none text-white @yield('active_app')"><i class="fa-solid fa-database m-2 my-2 "></i>{{ __('Gestion de l\'application') }}</a>
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-white @yield('active_stats')"><i class="fa-solid fa-chart-pie m-2 my-2"></i>{{ __('Statistique étudiant') }}</a>
            <a href="{{ route('card.index') }}" class="text-decoration-none text-white @yield('active_card')"><i class="fa-solid fa-clipboard-list m-2 my-2"></i>{{ __('Carte créées') }}</a>
            <a href="{{ route('admin.profil.index') }}" class="text-decoration-none text-white @yield('active_profil')"><i class="fa-solid fa-user-plus m-2"></i>{{ __('Profils étudiant, Enseignant') }}</a>
            <!-- Add more links here -->
        </div>
        @elseif(auth()->user()->hasRole('etudiant'))
        <div class="list-group list-group-flush px-2 p-2 fs-5 pt-5 text-decoration-none">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase text-white mt-3 hover-bg my-4 @yield('active_dashboard')"><i class="fa-solid fa-house m-2"></i><span>{{ __('SUP\'PER CARTE') }}</span></a>
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-uppercase text-white hover-bg my-3"><i class="fa-solid fa-table-cells-large m-2"></i>{{ __('Tableau de bord') }}</a>
            <a href="{{ route('parameters') }}" class="text-decoration-none text-white @yield('active_parameters')"><i class="fa-solid fa-gear m-2 my-2 "></i>{{ __('Paramètres') }}</a>
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-white @yield('active_stats')"><i class="fa-solid fa-chart-pie m-2 my-2"></i>{{ __('Statistiques') }}</a>
            <a href="{{ route('card.index') }}" class="text-decoration-none text-white @yield('active_card')"><i class="fa-solid fa-clipboard-list m-2 my-2"></i>{{ __('Cartes créées') }}</a>
            <a href="{{ route('card.favcard') }}" class="text-decoration-none text-white @yield('active_favcard')"><i class="fa-solid fa-heart m-2 my-2"></i>{{ __('Cartes préférées') }}</a>
            
            <!-- Add more links here -->
        </div>
        @elseif(auth()->user()->hasRole('enseignant'))
=======
>>>>>>> 08b01d964905b2c34015dbf6714f0041cd2aeb76

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
