<div>
    @if($step == 1)
    <div class="form-group row">
        <label for="matiere_id" class="col-md-4 col-form-label text-md-right">{{ __('Matiere') }}</label>
        <div class="col-md-6">
            <select wire:model="selectedMatiere" wire:change="updateChapitres" id="matiere_id" class="form-control @error('matiere_id') is-invalid @enderror" name="matiere_id[]" wire:key="matieres" multiple>
                @foreach ($matieres as $matiere)
                    <option value="{{$matiere->id}}" class="option-style" {{ in_array($matiere->id, old('matiere_id', [])) ? 'selected' : '' }}>{{ $matiere->label }}</option>
                @endforeach
            </select>

            @error('matiere_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <button class="btn-custom-border-grey"  wire:click="nextStep" type="button">Suivant</button>
    </div>
    @endif



    @if($step == 2)
    <div class="d-flex">
    <button wire:click="previousStep" class="btn-return" type="button"></button>
    <p class="fs-6 fw-bold ms-2 mt-1">Choisis la maitère</p>
    </div>
    <div class="form-group row">
        <label for="card_chapitre_id" class="col-md-4 col-form-label text-md-right">{{ __('Chapitre') }}</label>
        <div class="col-md-6">
            <select wire:model="selectedChapitre" id="card_chapitre_id" class="form-control @error('card_chapitre_id') is-invalid @enderror" name="card_chapitre_id[]" wire:key="chapitres" multiple>
                @foreach ($chapitres as $id => $label)
                    <option value="{{ $id }}" {{ in_array($id, (array)old('card_chapitre_id')) ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
    
            @error('card_chapitre_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button class="btn-custom-border-grey"  wire:click="nextStep" type="button">Suivant</button>
        </div>
    @endif

    @if($step == 3)
    <div class="d-flex">
        <button wire:click="previousStep" class="btn-return" type="button"></button>
        <p class="fs-6 fw-bold ms-2 mt-1">Choisis la maitère</p>
    </div>
    <div class="form-group row">
        <label for="card_level_id" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
        <div class="col-md-6">

            <select wire:model="selectedLevel" id="card_level_id" class="form-control @error('card_level_id') is-invalid @enderror" name="card_level_id[]" multiple>
                @foreach ($cardLevels as $level)
                    <option value="{{ $level->id }}" {{ in_array($level->id, old('card_level_id', [])) ? 'selected' : '' }}>{{ $level->label }}</option>
                @endforeach
            </select>

            @error('level')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <button class="btn-custom-border-grey"  wire:click="nextStep" type="button">Suivant</button>
    </div>
    @endif



    @if($step == 4)
    <div class="d-flex">
        <button wire:click="previousStep" class="btn-return" type="button"></button>
        <p class="fs-6 fw-bold ms-2 mt-1">Choisis la maitère</p>
        </div>
    <div class="form-group row">
        <label for="number_card" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de carte') }}</label>
        <div class="col-md-6">
            <select wire:model="selectedMatiere" wire:change="updateChapitres" id="matiere_id" class="form-control @error('matiere_id') is-invalid @enderror" name="matiere_id[]" wire:key="matieres" multiple hidden>
                @foreach ($matieres as $matiere)
                <option value="{{$matiere->id}}" class="option-style" {{ in_array($matiere->id, old('matiere_id', [])) ? 'selected' : '' }}>{{ $matiere->label }}</option>
                @endforeach
            </select>
            <select wire:model="selectedChapitre" id="card_chapitre_id" class="form-control @error('card_chapitre_id') is-invalid @enderror" name="card_chapitre_id[]" wire:key="chapitres" multiple hidden>
                @foreach ($chapitres as $id => $label)
                    <option value="{{ $id }}" {{ in_array($id, (array)old('card_chapitre_id')) ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <select wire:model="selectedLevel" id="card_level_id" class="form-control @error('card_level_id') is-invalid @enderror" name="card_level_id[]" multiple hidden>
                @foreach ($cardLevels as $level)
                <option value="{{ $level->id }}" {{ in_array($level->id, old('card_level_id', [])) ? 'selected' : '' }}>{{ $level->label }}</option>
            @endforeach
            </select>
            <select wire:model="selectedNumberCard" id="number_card" class="form-control @error('number_card') is-invalid @enderror" name="number_card" >
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
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn-custom-border-grey">
                {{ __('Selectionner') }}
            </button>
        </div>
    </div>
    @endif
</div>




