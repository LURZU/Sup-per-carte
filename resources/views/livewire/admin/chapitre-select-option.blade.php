<div>
    <h3>Création de la matière</h3>

    <div class="form-group">
        <label for="label">Label de la matière</label>
        <input wire:model="label" id="label" type="text" class="form-control">
    </div>

    <h3>Assignation des chapitres</h3>
    <button wire:click="addChapitre" class="btn btn-primary mb-3">Ajouter un chapitre</button>

    <table class="table">
        <thead>
            <tr>
                <th>Label</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chapitres as $key => $chapitre)
                <tr>
                    <td>
                        <input type="text" wire:model="chapitres.{{ $key }}.label" class="form-control">
                    </td>
                    <td>
                        <button wire:click="removeChapitre({{ $key }})" class="btn btn-danger">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button wire:click="save" class="btn btn-primary">Enregistrer</button>
    <button wire:click="return" class="btn btn-secondary">Retour</button>
</div>
