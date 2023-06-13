<x-app-layout>
    @section('title', 'Dashboard')
    @section('active_dashboard', 'active')
     @if(session('success'))
     <div class="alert alert-success">{{ session('success') }}</div>
     @endif

     @if(session('error'))
     <div class="alert alert-danger">{{ session('error') }}</div>
     @endif

                @if(auth()->user()->hasRole('admin'))
                    <div class="d-flex flex-row flex-column flex-lg-row py-3">
                        <div class="row mx-0 w-100">
                            <div class="col-12 col-lg-8">
                                <div class="row">
                                    <x-buttons.dashboard-button link="parameters" icon="cog" label="Paramètres" class="col-lg-6" />
                                    <x-buttons.dashboard-button link="stats.index" icon="chart-pie" label="Statistiques étudiant" class="col-lg-6" />
                                    <x-buttons.dashboard-button link="parameters" icon="clipboard-list" label="Cartes crées" class="col-lg-6" />
                                    <x-buttons.dashboard-button link="admin.profil.index" icon="user-plus" label="Profils étudiant, Enseignants" class="col-lg-6" />
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <x-buttons.dashboard-button link="card.index" icon="plus-circle" label="Créer une carte" class="col-lg-12 h-100 dashboard-col-2" />
                            </div>



                        </div>
{{--                        <div class="w-50 h-50">--}}
{{--                            <div class="d-flex h-75 align-items-stretch ms-3 shadow">--}}
{{--                                <ul class="list-group text-center w-100 h-100">--}}
{{--                                    <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">--}}
{{--                                        <div>--}}
{{--                                            <i class="fas fa-plus-circle ml-2 fa-xl"></i>--}}
{{--                                            <div><a style="font-size: 20px; color: #333333" href="{{route('card.index')}}">Créer une carte</a></div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>

                @elseif(auth()->user()->hasRole('etudiant'))
                <div class="d-flex flex-row" style="height:100vh!important">
                    <div class="w-50 h-25 pb-2">
                        <div class="row g-0 h-75">
                            <div class="col">
                                <ul class="list-group text-center h-100 me-3">
                                    <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                        <div>
                                            <i class="fa fa-cog fa-xl"></i>
                                            <div><a class="fs-5" style="font-size: 20px; color: #333333" href="{{route('parameters')}}">Paramètres</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group text-center h-100">
                                    <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                        <div>
                                            <i class="fa-solid fa-chart-pie m-2 my-2 fa-xl"></i>
                                            <div><a  style="font-size: 20px; color: #333333" href="{{route('parameters')}}">Mes statistiques</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row g-0 mt-3 h-75">
                            <div class="col">
                                <ul class="list-group text-center h-100 me-3">
                                    <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                        <div>
                                            <i class="fa-solid fa-clipboard-list m-2 my-2 fa-xl"></i>
                                            <div><a style="font-size: 20px; color: #333333" href="{{route('parameters')}}">Cartes crées</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group text-center h-100">
                                    <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                        <div>
                                            <i class="fa-solid fa-heart fa-xl"></i>
                                            <div><a style="font-size: 20px; color: #333333" href="{{route('admin.profil.index')}}">Carte préférées</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-50 h-50">
                        <div class="d-flex h-75 align-items-stretch ms-3 shadow">
                            <ul class="list-group text-center w-100 h-100">
                                <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                    <div>
                                        <i class="fas fa-plus-circle ml-2 fa-xl"></i>
                                        <div><a style="font-size: 20px; color: #333333" href="{{route('card.index')}}">Créer une carte</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @elseif(auth()->user()->hasRole('enseignant'))
                <div class="d-flex flex-row" style="height:100vh!important">
                    <div class="w-50 h-25 pb-2">
                        <div class="row g-0 h-75">
                            <div class="col">
                                <ul class="list-group text-center h-100 me-3">
                                    <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                        <div>
                                            <i class="fa fa-cog fa-xl"></i>
                                            <div><a class="fs-5" style="font-size: 20px; color: #333333" href="{{route('parameters')}}">Paramètres</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row g-0 mt-3 h-75">
                            <div class="col">
                                <ul class="list-group text-center h-100 me-3">
                                    <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                        <div>
                                            <i class="fa-solid fa-clipboard-list m-2 my-2 fa-xl"></i>
                                            <div><a style="font-size: 20px; color: #333333" href="{{route('parameters')}}">Cartes crées</a></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-50 h-50">
                        <div class="d-flex h-75 align-items-stretch ms-3 shadow">
                            <ul class="list-group text-center w-100 h-100">
                                <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                    <div>
                                        <i class="fas fa-plus-circle ml-2 fa-xl"></i>
                                        <div><a style="font-size: 20px; color: #333333" href="{{route('card.index')}}">Créer une carte</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif



</x-app-layout>
