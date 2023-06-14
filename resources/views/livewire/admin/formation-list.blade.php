@section('active_app', 'active')
@section('content')
<div class="container">
    <button class="btn btn-primary" wire:click="addFormation()">Créer une formation</button>
    @if($newFormation)
    <div class="form-group">
        <label for="labelInput">Label</label>
            <input id="labelInput" type="text" class="form-control" wire:model="newFormationLabel">
    </div>
    <div class="form-group">
        <label for="matieresInput">Matieres</label>
        <select id="matieresInput" multiple class="form-control" multiple wire:model="matiereIds">
            @foreach($matieres as $matiere)
                <option value="{{ $matiere->id }}">{{ $matiere->label }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary" wire:click="createFormation">Enregistrer</button>
    <button class="btn btn-secondary" wire:click="cancelCreateFormation">Annuler</button>
@endif

    @foreach($formations as $formation)
        <div class="card mb-3">
            <div class="card-body">
                @if($editingFormation && $formationId == $formation->id)
                    <div class="form-group">
                        <label for="labelInput">Label</label>
                        <input id="labelInput" type="text" class="form-control" wire:model="label">
                    </div>
                    <div class="form-group">
                        <label for="matiereSelect">Matieres</label>
                        <select id="matiereSelect" class="form-control" name="matieres[]" multiple wire:model="matiereIds">
                            @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" wire:click="updateFormation">Enregistrer</button>
                    <button class="btn btn-secondary" wire:click="cancelEditFormation">Annuler</button>
                @else
                    <h5 class="card-title">Formation : {{ $formation->label }}</h5>
                    <p class="card-text">Matières :</p>
                    <ul>
                        @foreach($formation->matieres as $matiere)
                            <li>{{ $matiere->label }}</li>
                        @endforeach
                    </ul>
                    <button class="btn btn-primary" wire:click="editFormation({{ $formation->id }})">Modifier</button>
                    <button class="btn btn-danger" wire:click="deleteFormation({{ $formation->id }})">Supprimer</button>
                @endif
            </div>
        </div>
    @endforeach
</div>
