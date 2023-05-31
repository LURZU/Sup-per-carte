<div class="container">
    <h1>Liste des chapitres ({{$matiere_name}})</h1>
    <button class="btn btn-primary" wire:click="addChapitre()">Créer un chapitre</button>
    @if($newChapitre)
        <div class="form-group">
            <label for="labelInput">Label</label>
            <input id="labelInput" type="text" class="form-control" wire:model="newChapitreLabel">
        </div>
        <button class="btn btn-primary" wire:click="createChapitre">Enregistrer</button>
        <button class="btn btn-secondary" wire:click="cancelCreateChapitre">Annuler</button>
    @endif
    @foreach($chapitres as $chapitre)
        <div class="card mb-3">
            <div class="card-body">
                @if($editingChapitre && $chapitreId == $chapitre->id)
                    <div class="form-group">
                        <label for="labelInput">Label</label>
                        <input id="labelInput" type="text" class="form-control" wire:model="label">
                    </div>
                    <button class="btn btn-primary" wire:click="updateChapitre">Enregistrer</button>
                    <button class="btn btn-secondary" wire:click="cancelEditChapitre">Annuler</button>
                @else
                    <h5 class="card-title">Chapitre : {{ $chapitre->label }}</h5>
                    <button class="btn btn-primary" wire:click="editChapitre({{ $chapitre->id }})">Modifier</button>
                    <button class="btn btn-danger" wire:click="deleteChapitre({{ $chapitre->id }})">Supprimer</button>
                @endif
            </div>
        </div>
    @endforeach
</div>
