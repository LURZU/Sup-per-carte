@section('title', "Sup'Per Carte - Gestion des cartes")

    <div class="row justify-content-center">
        <div class="w-100">
            <div class="card border-0">
            
                <div class="card-body p-0">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        @if(auth()->user()->hasRole('etudiant'))
                        @include('components.radio-select-input-semestre')
                        @endif

                     
    
                        @livewire('card.dynamic-matiere-select-unique', ['matiereId' => $matiereId, 'chapitreId' => $chapitreId, 'formationId' => $formationId, 'card' => $card, 'cardLevels' => $cardLevels, 'cardLevelId' => $cardLevelId] )

                        <div class="row">

                        <!-- End of the new grid layout -->

                        @if(auth()->user()->hasRole('admin'))
                        <script>
                            function selectUser() {
                                document.getElementById('created_by_admin').checked = false;
                                document.getElementById('created_by_user').checked = true;
                            }

                            function selectAdmin() {
                                document.getElementById('created_by_admin').checked = true;
                                document.getElementById('created_by_user').checked = false;
                            }
                        </script>
                        <div class="d-flex mt-4">
                        <div class="pb-0 tab-pane fade show active w-50 me-4">
                            <div id="card-header" class="d-flex flex-wrap justify-content-between" style="">
                                <div class="d-flex justify-content-end">
                                  <div class="btn-group">
                                      <button class="btn btn-secondary dropdown-toggle disablebg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <span class="bg-white p-2" style="border-radius: 100%; padding: 1px 7px!important;"><i class="fa-solid fa-plus fa-2xs" style="color: #606060; "></i></span>
                                      </button>
                                  </div>
                                </div>
                                  <div class="w-75">
                                  <h3 class="fw-bold text-center mb-1">Question</h3>
                                  </div> 
                                  <div class="d-flex justify-content-end">
                                    <p></p>
                                  </div>
                            </div>
                            <textarea style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px; resize: none; height: 200px;" id="question" type="text" class=" w-100 p-3 form-control @error('question') is-invalid @enderror" name="question" value="" placeholder="Question">{{ old('question', $card->question) }}</textarea>
                        </div>

                        <div class="pb-0 tab-pane fade show active w-50">
                            <div id="card-header" class="d-flex flex-wrap justify-content-between" style="">
                                <div class="d-flex justify-content-end">
                                  <div class="btn-group">
                                      <button class="btn btn-secondary dropdown-toggle disablebg" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <span class="bg-white p-2" style="border-radius: 100%; padding: 1px 7px!important;"><i class="fa-solid fa-plus fa-2xs" style="color: #606060; "></i></span>
                                      </button>
                                  </div>
                                </div>
                                  <div class="w-75">
                                  <h3 class="fw-bold text-center mb-1">Réponse</h3>
                                  </div> 
                                  <div class="d-flex justify-content-end">
                                    <p></p>
                                  </div>
                            </div>
                                <textarea style="background-color: #D5D5D5; border-radius: 0px 0px 6px 6px; resize: none;     height: 200px; " id="response" type="text" class=" w-100 p-3 form-control @error('response') is-invalid @enderror" name="response" value="" placeholder="Réponse">{{ old('response', $card->response) }}</textarea>
                        </div>
                        </div> 
                        <h5 class="mt-4 mb-2">Qui a crée la carte ?</h5>
                        <div class="form-group row mb-2">
                            <div class="col-md-6">
                                <label>
                                    <input type="radio" id="created_by_admin" name="created_by" value="admin" {{ old('created_by', $card->created_by) == 'admin' ? 'checked' : '' }}  onchange="selectAdmin()"> Moi ({{ auth()->user()->name }})
                                </label>

                                @error('created_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6 d-flex">
                                <input type="radio" id="created_by_user" name="created_by_user" disabled value="{{ $card->user_id }}">
                                <select id="created_by_user" class="form-select border-0 ms-1 @error('created_by') is-invalid @enderror" name="created_by"  onclick="selectUser()" style="width: 250px">
                                    <option>Selectionner un étudiant</option>
                                    @foreach ($allUser as $user)
                                        <option value="{{ $user->name }}:{{ $user->id }}" {{ old('created_by', $card->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                @error('created_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #333333 ; border-color: #333333">
                                    @if($card->id)
                                    {{ __('Confirmer la modification') }}
                                    @else
                                    {{ __('Créer la carte') }}
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<script src="{{ asset('js/app.js') }}"></script>
