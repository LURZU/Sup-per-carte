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


                <div class="d-flex response-mobile mb-4">
                    <div class="w-50 dropdown">
                        <button class="btn btn-primary bg-white border text-dark" wire:click="toggleDropdown">
                            Filtrer <i class="fa-solid fa-sliders"></i></button>
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
                    <select class="w-50 form-select ms-4" wire:model="sorting">
                        <option value="default" selected hidden disabled>Trier par</option>
                        <option value="asc">Plus anciennes</option>
                        <option value="desc">Plus récentes</option>
                    </select>
                </div>
            </div>

{{--            {{ dd($list_card) }}--}}

            @if(auth()->user()->hasRole('etudiant'))
                <div class="row  mt-4 ms-4 disable-margin-mobile">
                    @else
                        <div class="row overflow-auto">
                            @endif
{{--                            {{ dd($list_card_all) }}--}}
                            @forelse ($list_card_all as $list_card)
{{--                                <x-cards.card :card="$card"/>--}}
{{--                                {{ dd($list_card) }}--}}

                                <div class="col-md-6">

                                    <div class="card mb-4 shadow rounded-3 border-0">
                                        <div class="card-header bg-transparent border-0">
                                            <span class="card-number">Carte {{$list_card->id}}</span>
                                            <span
                                                class="card-creator">Créée par {{ $list_card->created_by }} {{ $list_card->created_at ? 'le ' . $list_card->created_at->format('d/m/Y') : '' }}</span>
                                        </div>

                                        <div class="card-body pt-1">
                                            <ul class="nav nav-tabs mb-2" id="myTab" role="tablist"
                                                style="border-bottom: 2px solid #D5D5D5;">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="question-tab" data-toggle="tab"
                                                       href="#question{{ $list_card->id }}" role="tab" aria-controls="question"
                                                       aria-selected="true">Question</a>
                                                </li>
                                                <li class="nav-item ms-4" role="presentation">
                                                    <a class="nav-link" id="answer-tab" data-toggle="tab"
                                                       href="#answer{{ $list_card->id }}" role="tab" aria-controls="answer"
                                                       aria-selected="false">Réponse</a>
                                                </li>
                                            </ul>

                                            <div class="tab-content" id="myTabContent">
                                                <div class="pb-0 tab-pane fade show active" id="question{{ $list_card->id }}"
                                                     role="tabpanel" aria-labelledby="question-tab">
                                                    <div id="card-header"
                                                         class="d-flex flex-wrap justify-content-between" style="">
                                                        <div class="d-flex justify-content-end mobile-w-15">
                                                            <div class="btn-group">
                                                                <button id="question-img-button-{{$list_card->id}}"
                                                                        class="btn btn-secondary dropdown-toggle disablebg"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                    <span class="bg-white p-2"
                                                                          style="border-radius: 100%; padding: 5px 10px!important;"><i
                                                                            class="fa-solid fa-plus fa-sm"
                                                                            style="color: #606060; "></i></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="w-75">
                                                            <h3 class="fw-bold text-center mb-1">Question</h3>
                                                            <p style="color:#c5c5c5; font-size: 14px;"
                                                               class="text-center mb-1">Matière {{$list_card->matiere}}
                                                                / Chap. {{$list_card->chapitre}} /
                                                                Niv. {{$list_card->level}}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-end ">
                                                            <div class="btn-group">
                                                                <button
                                                                    class="btn btn-secondary dropdown-toggle disablebg"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis-vertical fa-xl"
                                                                       style="color: white;"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item"
                                                                           href="{{ route('card.edit', ['card' => $list_card]) }}">Modifier</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" href="#"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#confirmDeleteModal"
                                                                           data-url="{{ route('card.del', ['card' => $list_card]) }}">Supprimer</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="w-100 p-3"
                                                         style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px;">
                                                        <p class="card-text"
                                                           style="color: #333333">{{$list_card->question}}</p>
                                                    </div>
                                                </div>
                                                <div class="pb-0 tab-pane fade" id="answer{{ $list_card->id }}" role="tabpanel"
                                                     aria-labelledby="answer-tab">

                                                    <div id="card-header"
                                                         class="d-flex flex-wrap justify-content-between" style="">
                                                        <div class="d-flex justify-content-end mobile-w-15">
                                                            <div class="btn-group">
                                                                <button id="response-img-button-{{$list_card->id}}"
                                                                        class="btn btn-secondary dropdown-toggle disablebg"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                    <span class="bg-white p-2"
                                                                          style="border-radius: 100%; padding: 5px 10px!important;"><i
                                                                            class="fa-solid fa-plus fa-sm"
                                                                            style="color: #606060; "></i></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="w-75">
                                                            <h3 class="fw-bold text-center mb-1">Réponse</h3>
                                                            <p style="color:#c5c5c5; font-size: 14px;"
                                                               class="text-center mb-1">Matière {{$list_card->matiere}}
                                                                / Chap. {{$list_card->chapitre}} /
                                                                Niv. {{$list_card->level}}</p>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <div class="btn-group">
                                                                <button
                                                                    class="btn btn-secondary dropdown-toggle disablebg"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    <i class="fa-solid fa-ellipsis-vertical fa-xl"
                                                                       style="color: white;"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item"
                                                                           href="{{ route('card.edit', ['card' => $list_card]) }}">Modifier</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item" href="#"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#confirmDeleteModal"
                                                                           data-url="{{ route('card.del', ['card' => $list_card]) }}">Supprimer</a>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="w-100 p-3"
                                                         style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px;">
                                                        <p class="card-text"
                                                           style="color: #333333">{{$list_card->response}}</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="question-img-modal-{{$list_card->id}}" class="modal">
                                    <div class="modal-content">
                                        <span class="close-pop-{{$list_card->id}}">&times;</span>
                                        <img id="question-img-{{$list_card->id}}" src="" alt="Question image">
                                    </div>
                                </div>

                                <script>
                                    var btn = document.getElementById("question-img-button-{{$list_card->id}}");
                                    var modal = document.getElementById("question-img-modal-{{$list_card->id}}");
                                    var img = document.getElementById("question-img-{{$list_card->id}}");
                                    var span = document.getElementsByClassName("close-pop-{{$list_card->id}}")[0];
                                    var btnresponse = document.getElementById("response-img-button-{{$list_card->id}}");
                                    var modal = document.getElementById("question-img-modal-{{$list_card->id}}");

                                    btn.onclick = function () {
                                        img.src = '{{$list_card->imageUrlQuestion()}}'; // Remplacer par le chemin de l'image correspondant à la question
                                        modal.style.display = "block";
                                    }

                                    btnresponse.onclick = function () {
                                        img.src = '{{$list_card->imageUrlResponse()}}'; // Remplacer par le chemin de l'image correspondant à la question
                                        modal.style.display = "block";
                                    }

                                    span.onclick = function () {
                                        modal.style.display = "none";
                                    }

                                    window.onclick = function (event) {
                                        if (event.target == modal) {
                                            modal.style.display = "none";
                                        }
                                    }
                                </script>

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
