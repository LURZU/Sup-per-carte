<x-app-layout>
    @section('active_app', 'active')
    @section('title', 'Gestion de l\'application')
    @if(auth()->user()->hasRole('admin'))
                    <div class="d-flex flex-row" style="height:100vh!important">
                        <div class="w-50 h-25 pb-2">
                            <div class="row g-0 h-75">
                                <div class="col">
                                    <ul class="list-group text-center h-100 pe-3">
                                        <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center ps-2">
                                            <div>
                                                <i class="fa-solid fa-school fa-xl"></i>
                                                <div><a class="fs-5" style="font-size: 20px; color: #333333" href="{{route('admin.formation.index')}}">Formation</a></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="list-group text-center h-100">
                                        <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                            <div>
                                                <i class="fa-solid fa-book m-2 my-2 fa-xl"></i>
                                                <div><a  style="font-size: 20px; color: #333333" href="{{route('admin.matiere.index')}}">Matière</a></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row g-0 mt-3 h-75">
                                
                                <div class="col">
                                    <ul class="list-group text-center h-100">
                                        <li class="list-group-item shadow h-100 d-flex align-items-center justify-content-center">
                                            <div>
                                                <i class="fa-solid fa-user-plus m-2 fa-xl"></i>
                                                <div><a style="font-size: 20px; color: #333333" href="{{route('admin.profil.index')}}">Profils étudiant, Enseignants</a></div>
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