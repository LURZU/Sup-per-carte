<div class="container">
    <h1>Liste des formations</h1>
    <button class="btn btn-primary" wire:click="addFormation()">Créer une formation</button>
    @if($newFormation)
        <div class="form-group">
            <label for="labelInput">Label</label>
            <input id="labelInput" type="text" class="form-control" wire:model="newFormationLabel">
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
                    <button class="btn btn-primary" wire:click="updateFormation">Enregistrer</button>
                    <button class="btn btn-secondary" wire:click="cancelEditFormation">Annuler</button>
                @else
                    <h5 class="card-title">Formation : {{ $formation->label }}</h5>
                    <button class="btn btn-primary" wire:click="editFormation({{ $formation->id }})">Modifier</button>
                    <button class="btn btn-danger" wire:click="deleteFormation({{ $formation->id }})">Supprimer</button>
                @endif
            </div>
        </div>
    @endforeach
</div>
