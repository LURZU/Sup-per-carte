@if (auth()->user())
        <div>
            <div class="card-filters-container px-3">
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('enseignant'))
                {{--Show Roles filter--}}
                    <div class="role-filter df-no-scrollbar btn-group  mb-4" role="group" aria-label="Basic radio toggle button group">
                        <x-buttons.card-filter-button id="btnradio1" label="Toutes" value="default"/>
                        <x-buttons.card-filter-button id="btnradio2" label="Étudiants" value="etudiant"/>
                        <x-buttons.card-filter-button id="btnradio3" label="Enseignants" value="enseignant"/>
                        <x-buttons.card-filter-button id="btnradio4" label="Admin" value="admin"/>
                    </div>

                @endif


                <div class="d-flex align-content-center response-mobile mb-4">
                    <div class="dropdown">
                        <button class="btn btn-primary bg-white border text-dark d-flex align-content-center flex-nowrap" wire:click="toggleDropdown">
                            Filtrer <i class="fa-solid fa-sliders mt-1 ms-1"></i></button>
                        @if($showDropdown)
                            <div class="dropdown-content df-w-75vw">
                                <div class="dropdown-panel d-block">

                                    <x-dropdowns.card-filter-dropdown model="formations" :items="$formations" show="show"/>
                                    <x-dropdowns.card-filter-dropdown model="matieres" :items="$matieres"/>
                                    <x-dropdowns.card-filter-dropdown model="chapitres" :items="$chapitres"/>
                                    <x-dropdowns.card-filter-dropdown model="niveaux" :items="$niveaux"/>

                                    <!-- Faites de même pour les chapitres et niveaux -->
                                </div>
                                <button class="w-100 text-white border-0 bg-dark py-3" id="apply-filters">Valider les filtres</button>
                            </div>
                        @endif
                    </div>

                    <div class="dropdown mx-2">
                        <button class="btn btn-light dropdown-toggle bg-white border rounded d-flex align-content-center flex-nowrap" type="button" 
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Trier par
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item disabled" href="#" wire:click="$set('sorting', 'default')">Trier par</a>
                            <a class="dropdown-item" href="#" wire:click="$set('sorting', 'asc')">Plus anciennes</a>
                            <a class="dropdown-item" href="#" wire:click="$set('sorting', 'desc')">Plus récentes</a>
                        </div>
                    </div>

{{--                    TODO: complete this--}}
                    <button class="btn btn-dark px-3 ms-2 rounded d-flex align-content-center flex-nowrap border" type="button" wire:click="resetFilters">
                        Rétablir
                    </button>

                </div>
            </div>

            @if(auth()->user()->hasRole('etudiant'))
                <div class="row  mt-4 ms-4 disable-margin-mobile">
                    @else
                        <div class="row overflow-auto">
                            @endif

                            @forelse ($list_card_all as $list_card)

                                <x-cards.card :card="$list_card"/>

                            @empty
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow">
                                        <div class="card-body">
                                            <h4>Aucune carte n'est disponible actuellement</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        @else
                            <h2>Vous n'êtes pas connecté</h2>
                            <button href="{{route('card.index')}}"></button>
                        @endif
                        <script src="{{ asset('js/app.js') }}"></script>
                </div>

        </div>
