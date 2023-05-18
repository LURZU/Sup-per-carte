@section('title', "Sup'Per Carte - Gestion des cartes")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Card') }}</div>

                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        @if(auth()->user()->hasRole('student'))
                        @include('components.radio-select-input-semestre')
                        @endif
                        

                        <livewire:dynamic-matiere-select-unique :matiereId="$matiereId" :chapitreId="$chapitreId" :formationId="$formationId" :card="$card" />

                        
                        <div class="form-group row">
                            <label for="card_level_id" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                            <div class="col-md-6">
                                <select id="card_level_id" class="form-control @error('card_level_id') is-invalid @enderror" name="card_level_id">
                                    <option value="" disabled selected>Niveau</option>
                                    @foreach ($cardLevels as $level)
                                        <option value="{{ $level->id }}" {{ old('card_level_id', $card->card_level_id) == $level->id ? 'selected' : '' }}>{{ $level->label }}</option>
                                    @endforeach
                                </select>

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>
                            <div class="col-md-6">
                                <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question', $card->question) }}">
                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="response" class="col-md-4 col-form-label text-md-right">{{ __('Response') }}</label>
                            <div class="col-md-6">
                                <input id="response" type="text" class="form-control @error('response') is-invalid @enderror" name="response" value="{{ old('response', $card->response) }}" >
                                @error('response')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    

                        @if(auth()->user()->hasRole('admin'))
                        <script>
                            function selectUser() {
                                document.getElementById('created_by_admin').checked = false; // Désélectionner le bouton radio "Créer par moi"
                                document.getElementById('created_by_user').checked = true; // Cocher le bouton radio de l'utilisateur sélectionné
                             
                            }

                            function selectAdmin() {
                                document.getElementById('created_by_admin').checked = true; // Désélectionner le bouton radio "Créer par moi"
                                document.getElementById('created_by_user').checked = false; // Cocher le bouton radio de l'utilisateur sélectionné
                             
                            }
                        </script>
                        <div class="form-group row">
                            <label for="created_by_admin" class="col-md-4 col-form-label text-md-right">{{ __('Créer par moi ('.$user->name.')') }}</label>
                            <div class="col-md-6">
                                <label>
                                    <input type="radio" id="created_by_admin" name="created_by" value="admin" {{ old('created_by', $card->created_by) == 'admin' ? 'checked' : '' }}  onchange="selectAdmin()"> Créer par moi
                                </label>
                        
                                @error('created_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="created_by_user" class="col-md-4 col-form-label text-md-right">{{ __('Created By') }}</label>
                            
                            <div class="col-md-6">
                                <input type="radio" id="created_by_user" name="created_by_user" disabled value="{{ $card->user_id }}">
                                <select id="created_by_user" class="form-control @error('created_by') is-invalid @enderror" name="created_by"  onclick="selectUser()">
                                    <option value="" disabled selected>Selectionner un utilisateur</option>
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
                                <button type="submit" class="btn btn-primary">
                                    @if($card->id)
                                    {{ __('Modifier') }}
                                    @else
                                    {{ __('Créer') }}
                                    @endif
                                </button>
                            </div>
                        </div>

                        
                    </form>
                </div>
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
