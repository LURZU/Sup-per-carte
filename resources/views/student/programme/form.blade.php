
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Card') }}</div>

                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="matiere_id" class="col-md-4 col-form-label text-md-right">{{ __('Matiere') }}</label>
                            <div class="col-md-6">
                                <select id="matiere_id" class="form-control @error('matiere_id') is-invalid @enderror" name="matiere_id" >
                                    <option value="" disabled selected>Selectionner une matière</option>
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>{{ $matiere->label }}</option>
                                    @endforeach
                                </select>

                                @error('matiere')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_level_id" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                            <div class="col-md-6">
                                <select id="card_level_id" class="form-control @error('card_level_id') is-invalid @enderror" name="card_level_id">
                                    <option value="" disabled selected>Selectionner un level</option>
                                    @foreach ($cardLevels as $level)
                                        <option value="{{ $level->id }}" {{ old('card_level_id') == $level->id ? 'selected' : '' }}>{{ $level->label }}</option>
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
                            <label for="card_chapitre" class="col-md-4 col-form-label text-md-right">{{ __('Chapitre') }}</label>
                            <div class="col-md-6">
                                <select id="card_chapitre" class="form-control @error('card_chapitre') is-invalid @enderror" name="card_chapitre[]" multiple>
                                    @for ($i = 1; $i <= 6; $i++)
                                        <option value="{{$i}}" {{ in_array($i, (array)old('card_chapitre')) ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                        
                                @error('card_chapitre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="number_card" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de carte') }}</label>
                            <div class="col-md-6">
                                <select id="number_card" class="form-control @error('number_card') is-invalid @enderror" name="number_card" >
                                    <option value="" disabled selected>Select a number of card</option>
                                    @for ($i = 5; $i <= 30; $i+=5)
                                        <option value="{{$i}}" {{ old($i) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('semestre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Selectionner') }}
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
