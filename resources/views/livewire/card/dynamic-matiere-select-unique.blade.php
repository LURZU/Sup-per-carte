<div class="row">
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('enseignant'))

    <div class="col-xl-9 w-100 mb-4">
        <h5 class="mb-3">Sélectionnez la formation</h4>
            <select wire:model="selectedFormation" wire:change="updateMatieres" id="fomration_id" style="background-color: #ACACAC ;" class="form-select select-icon py-3 px-2 mb-4 text-white @error('formation_id') is-invalid @enderror" name="formation_id" wire:key="matieres">
                <option value="" selected hidden>Formation</option>
                @foreach ($formations as $formation)
                    <option class="bg-white" style="color: #333333" value="{{$formation->id}}" {{ $formation->id, old('formation_id', []) ? 'selected' : '' }}>{{ $formation->label }}</option>
                @endforeach
            </select>
            @error('formation_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
       
 
            <h5 class="mb-3">Choisis le semestre</h4>
      @include('components.radio-select-input-semestre')
            </div>
    @endif
        <h5 class="mb-3">Sélectionnez la matière, le chapitre et le niveau</h4>  
        <div class="col-md-4">
                <select wire:model="selectedMatiere" wire:change="updateChapitres" id="matiere_id" style="background-color: #ACACAC ;" class="form-select text-white py-3  @error('matiere_id') is-invalid @enderror" name="matiere_id" wire:key="matieres">
                    <option value="" selected hidden>Matiere</option>
                    @foreach ($matieres as $matiere)
                        <option value="{{$matiere->id}}" {{ $matiere->id, old('matiere_id', []) ? 'selected' : '' }}>{{ $matiere->label }}</option>
                    @endforeach
                </select>

                @error('matiere_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          
        </div>


        <div class="col-md-4">
            
                <select wire:model="selectedChapitre" id="card_chapitre_id" style="background-color: #ACACAC ;" class="form-select text-white py-3 @error('card_chapitre_id') is-invalid @enderror" name="card_chapitre_id" wire:key="chapitres">
                    <option value="" selected hidden>Chapitre</option>
                    @foreach ($chapitres as $id => $label)
                        <option value="{{ $id }}" {{ $id, (array)old('card_chapitre_id') ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
        
                @error('card_chapitre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           
            </div>
            <div class="col-md-4">
                <select id="card_level_id" style="background-color: #ACACAC ;" class="form-select text-white py-3 @error('card_level_id') is-invalid @enderror" name="card_level_id" placeholder="Niveau">
                    <option value="" hidden selected>Niveau</option>
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
</div>