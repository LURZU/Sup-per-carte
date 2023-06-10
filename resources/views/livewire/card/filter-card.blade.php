    @if (auth()->user())
    <div>
    <div class="d-flex justify-content-between mb-4">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check mx-2 rounded" name="btnradio" id="btnradio1" wire:model="role" value="default" autocomplete="off" checked>
            <label class="btn btn-outline-secondary mx-2 rounded" for="btnradio1">Tous</label>

            <input type="radio" class="btn-check mx-2 rounded" name="btnradio" id="btnradio2" wire:model="role" value="etudiant" autocomplete="off">
            <label class="btn btn-outline-secondary mx-2 rounded" for="btnradio2">Étudiants</label>

            <input type="radio" class="btn-check mx-2 rounded" name="btnradio" id="btnradio3" wire:model="role" value="enseignant" autocomplete="off">
            <label class="btn btn-outline-secondary mx-2 rounded" for="btnradio3">Enseignants</label>

            <input type="radio" class="btn-check mx-2 rounded" name="btnradio" id="btnradio4" wire:model="role" value="admin" autocomplete="off">
            <label class="btn btn-outline-secondary mx-2 rounded" for="btnradio4">Admin</label>
        </div>



        <div class="w-25 d-flex flex-wrap justify-content-between">
          <div class="dropdown">
            <button class="btn btn-primary bg-white border" style="color: #333333; border-color: #333333!important;" wire:click="toggleDropdown">Filtrer <i class="fa-solid fa-sliders"></i></button>
            @if($showDropdown)
                <div class="dropdown-content">
                    <div class="dropdown-panel d-block">
                        <button class="btn formations fw-bold" type="button">
                            Formations
                            <i class="fa-solid fa-chevron-up justify-content-end"></i>
                        </button>
                        <div id="formationsCheckboxes" class="ms-4 collapse formations show">
                            @foreach ($formations as $formation)
                                <label><input type="checkbox" value="{{$formation->id}}"> {{$formation->label}}</label><br>
                            @endforeach
                        </div>

                        <button class="btn matieres fw-bold" type="button">
                            Matières
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div id="matieresCheckboxes" class="ms-4 collapse matieres">
                            @foreach ($matieres as $matiere)
                                <label><input type="checkbox"  value="{{$matiere->id}}"> {{$matiere->label}}</label><br>
                            @endforeach
                        </div>

                        <button class="btn chapitres fw-bold" type="button">
                          Chapitres
                          <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div id="chapitresCheckboxes" class="ms-4 collapse chapitres">
                            @foreach ($chapitres as $chapitre)
                                <label><input type="checkbox"  value="{{$chapitre->id}}"> {{$chapitre->label}}</label><br>
                            @endforeach
                        </div>

                        <button class="btn niveaux fw-bold" type="button">
                          Niveaux
                          <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div id="niveauxCheckboxes" class="ms-4 collapse niveaux">
                            @foreach ($niveaux as $niveau)
                                <label><input type="checkbox"  value="{{$niveau->id}}"> {{$niveau->label}}</label><br>
                            @endforeach
                        </div>

                        <!-- Faites de même pour les chapitres et niveaux -->
                    </div>
                    <button class="w-100 text-white border-0" style="background-color:#606060; height: 35px; " id="apply-filters">Valider les filtres</button>
                </div>
            @endif
          </div>
          <select class="form-select ms-4" style="width: 50%;  border-color: #333333;" wire:model="sorting">
            <option value="default" selected hidden disabled>Trier par</option>
            <option  value="asc">Date de création - Croissante</option>
            <option value="desc">Date de création - Décroissante</option>
          </select>
        </div>
      </div>

      <div class="row overflow-auto">

        @forelse ($list_card_all as $key => $list_card)

{{--              {{ dd($list_card->created_by) }}--}}
        <div class="col-md-6">

            <div class="card mb-4 shadow rounded-3 border-0">
                <div class="card-header bg-transparent border-0">
                    <span class="card-number">Carte {{$key+1}}</span>
                    <span class="card-creator">Créée par {{ $list_card->created_by }} le {{$list_card->created_at ? $list_card->created_at->format('d/m/Y') : '-'}}</span>
                </div>

                <div class="card-body pt-1">
                    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist" style="border-bottom: 2px solid #D5D5D5;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="question-tab" data-toggle="tab" href="#question{{$key}}" role="tab" aria-controls="question" aria-selected="true">Question</a>
                        </li>
                        <li class="nav-item ms-4" role="presentation">
                            <a class="nav-link" id="answer-tab" data-toggle="tab" href="#answer{{$key}}" role="tab" aria-controls="answer" aria-selected="false">Réponse</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="pb-0 tab-pane fade show active" id="question{{$key}}" role="tabpanel" aria-labelledby="question-tab">
                          <div id="card-header" class="d-flex flex-wrap justify-content-between" style="">
                            <div class="d-flex justify-content-end">
                              <div class="btn-group">
                                  <button id="question-img-button-{{$list_card->id}}"  class="btn btn-secondary dropdown-toggle disablebg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <span class="bg-white p-2" style="border-radius: 100%; padding: 5px 10px!important;"><i class="fa-solid fa-plus fa-sm" style="color: #606060; "></i></span>
                                  </button>
                              </div>
                          </div>
                              <div class="w-75">
                              <h3 class="fw-bold text-center mb-1">Question</h3>
                              <p style="color:#c5c5c5; font-size: 14px;" class="text-center mb-1">Matière {{$list_card->matiere}} / Chap. {{$list_card->chapitre}} / Niv. {{$list_card->level}}</p>
                              </div>
                              <div class="d-flex justify-content-end">
                                <div class="btn-group">
                                    <button class="btn btn-secondary dropdown-toggle disablebg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical fa-xl" style="color: white;"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li> <a class="dropdown-item" href="{{ route('card.edit', ['card' => $list_card]) }}">Modifier</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-url="{{ route('card.del', ['card' => $list_card]) }}">Supprimer</a>
                                        </li>
                                    </ul>
                                </div>
                              </div>
                              </div>
                          <div class="w-100 p-3" style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px;">
                            <p class="card-text" style="color: #333333">{{$list_card->question}}</p>
                          </div>
                        </div>
                        <div class="pb-0 tab-pane fade" id="answer{{$key}}" role="tabpanel" aria-labelledby="answer-tab">

                          <div id="card-header" class="d-flex flex-wrap justify-content-between" style="">
                              <div class="d-flex justify-content-end">
                                <div class="btn-group">
                                    <button id="response-img-button-{{$list_card->id}}" class="btn btn-secondary dropdown-toggle disablebg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="bg-white p-2" style="border-radius: 100%; padding: 5px 10px!important;"><i class="fa-solid fa-plus fa-sm" style="color: #606060; "></i></span>
                                    </button>
                                </div>
                              </div>
                                <div class="w-75">
                                <h3 class="fw-bold text-center mb-1">Réponse</h3>
                                <p style="color:#c5c5c5; font-size: 14px;" class="text-center mb-1">Matière {{$list_card->matiere}} / Chap. {{$list_card->chapitre}} / Niv. {{$list_card->level}}</p>
                                </div>
                                <div class="d-flex justify-content-end">
                                  <div class="btn-group">
                                      <button class="btn btn-secondary dropdown-toggle disablebg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="fa-solid fa-ellipsis-vertical fa-xl" style="color: white;"></i>
                                      </button>
                                      <ul class="dropdown-menu">
                                          <li> <a class="dropdown-item" href="{{ route('card.edit', ['card' => $list_card]) }}">Modifier</a></li>
                                          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-url="{{ route('card.del', ['card' => $list_card]) }}">Supprimer</a>
                                      </ul>
                                  </div>
                                </div>
                              </div>
                          <div class="w-100 p-3" style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px;">
                            <p class="card-text" style="color: #333333">{{$list_card->response}}</p>
                          </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

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
    <div id="question-img-modal-{{$list_card->id}}" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="question-img-{{$list_card->id}}" src="" alt="Question image">
        </div>
    </div>

<script>
    var btn = document. getElementById("question-img-button-{{$list_card->id}}");
    var modal = document.getElementById("question-img-modal-{{$list_card->id}}");
    var img = document.getElementById("question-img-{{$list_card->id}}");
    var span = document.getElementsByClassName("close")[0];
    var btnresponse = document.getElementById("response-img-button-{{$list_card->id}}");
    var modal = document.getElementById("question-img-modal-{{$list_card->id}}");

    btn.onclick = function() {
        img.src = '{{$list_card->imageUrlQuestion()}}'; // Remplacer par le chemin de l'image correspondant à la question
        modal.style.display = "block";
    }

    btnresponse.onclick = function() {
        img.src = '{{$list_card->imageUrlResponse()}}'; // Remplacer par le chemin de l'image correspondant à la question
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
