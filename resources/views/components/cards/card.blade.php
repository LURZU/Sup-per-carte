<div class="col-md-6">

    <div class="card mb-4 shadow rounded-3 border-0">
        <div class="card-header bg-transparent border-0">
            <span class="card-number me-2">Carte {{ $card->id  }}</span>
            <span
                class="card-creator">Créée par {{ $card->created_by }} {{$card->created_at ?  'le ' . $card->created_at->format('d/m/Y') : ''}}</span>
        </div>

        <div class="card-body pt-1">
            <ul class="nav nav-tabs mb-2" id="myTab" role="tablist"
                style="border-bottom: 2px solid #D5D5D5;">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="question-tab" data-toggle="tab"
                       href="#question{{ $card->id }}" role="tab" aria-controls="question"
                       aria-selected="true">Question</a>
                </li>
                <li class="nav-item ms-4" role="presentation">
                    <a class="nav-link" id="answer-tab" data-toggle="tab"
                       href="#answer{{ $card->id }}" role="tab" aria-controls="answer"
                       aria-selected="false">Réponse</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="pb-0 tab-pane fade show active" id="question{{ $card->id }}"
                     role="tabpanel" aria-labelledby="question-tab">
                    <div id="card-header"
                         class="d-flex flex-wrap justify-content-between" style="">
                        <div class="d-flex justify-content-end mobile-w-15">
                            <div class="btn-group">
                                <button id="question-img-button-{{$card->id}}"
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
                               class="text-center mb-1">Matière {{$card->matiere}}
                                / Chap. {{$card->chapitre}} /
                                Niv. {{$card->level}}</p>
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
                                           href="{{ route('card.edit', ['card' => $card]) }}">Modifier</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#confirmDeleteModal"
                                           data-url="{{ route('card.del', ['card' => $card]) }}">Supprimer</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 p-3"
                         style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px;">
                        <p class="card-text"
                           style="color: #333333">{{$card->question}}</p>
                    </div>
                </div>
                <div class="pb-0 tab-pane fade" id="answer{{ $card->id }}" role="tabpanel"
                     aria-labelledby="answer-tab">

                    <div id="card-header"
                         class="d-flex flex-wrap justify-content-between" style="">
                        <div class="d-flex justify-content-end mobile-w-15">
                            <div class="btn-group">
                                <button id="response-img-button-{{$card->id}}"
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
                               class="text-center mb-1">Matière {{$card->matiere}}
                                / Chap. {{$card->chapitre}} /
                                Niv. {{$card->level}}</p>
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
                                           href="{{ route('card.edit', ['card' => $card]) }}">Modifier</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#confirmDeleteModal"
                                           data-url="{{ route('card.del', ['card' => $card]) }}">Supprimer</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 p-3"
                         style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px;">
                        <p class="card-text"
                           style="color: #333333">{{$card->response}}</p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<div id="question-img-modal-{{$card->id}}" class="modal">
    <div class="modal-content">
        <span class="close-pop-{{$card->id}}">&times;</span>
        <img id="question-img-{{$card->id}}" src="" alt="Question image">
    </div>
</div>

<script>
    {{--var btn = document.getElementById("question-img-button-{{$card->id}}");--}}
    {{--var modal = document.getElementById("question-img-modal-{{$card->id}}");--}}
    {{--var img = document.getElementById("question-img-{{$card->id}}");--}}
    {{--var span = document.getElementsByClassName("close-pop-{{$card->id}}")[0];--}}
    {{--var btnresponse = document.getElementById("response-img-button-{{$card->id}}");--}}
    {{--var modal = document.getElementById("question-img-modal-{{$card->id}}");--}}

    {{--btn.onclick = function () {--}}
    {{--    img.src = '{{$card->imageUrlQuestion()}}'; // Remplacer par le chemin de l'image correspondant à la question--}}
    {{--    modal.style.display = "block";--}}
    {{--}--}}

    {{--btnresponse.onclick = function () {--}}
    {{--    img.src = '{{$card->imageUrlResponse()}}'; // Remplacer par le chemin de l'image correspondant à la question--}}
    {{--    modal.style.display = "block";--}}
    {{--}--}}

    {{--span.onclick = function () {--}}
    {{--    modal.style.display = "none";--}}
    {{--}--}}

    {{--window.onclick = function (event) {--}}
    {{--    if (event.target == modal) {--}}
    {{--        modal.style.display = "none";--}}
    {{--    }--}}
    {{--}--}}
</script>
