<div class="col-md-6">

    <div class="card mb-4 shadow rounded-3 border-0">
        <div class="card-header bg-transparent border-0">
            <span class="card-number">Carte {{$key+1}}</span>
            <span
                class="card-creator">Créée par {{ $list_card->created_by }} le {{$list_card->created_at ? $list_card->created_at->format('d/m/Y') : '-'}}</span>
        </div>

        <div class="card-body pt-1">
            <ul class="nav nav-tabs mb-2" id="myTab" role="tablist"
                style="border-bottom: 2px solid #D5D5D5;">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="question-tab" data-toggle="tab"
                       href="#question{{$key}}" role="tab" aria-controls="question"
                       aria-selected="true">Question</a>
                </li>
                <li class="nav-item ms-4" role="presentation">
                    <a class="nav-link" id="answer-tab" data-toggle="tab"
                       href="#answer{{$key}}" role="tab" aria-controls="answer"
                       aria-selected="false">Réponse</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="pb-0 tab-pane fade show active" id="question{{$key}}"
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
                <div class="pb-0 tab-pane fade" id="answer{{$key}}" role="tabpanel"
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
