<div>
    <label for="total_card_to_show">Nombre de cartes dans le deck</label>
    <input wire:model="total_card_toshow" id="total_card_toshow" type="number" min="0" class="form-control">
    <button wire:click="increments" class="btn btn-secondary mt-2">+</button>
    <button wire:click="decrements" class="btn btn-secondary mt-2">-</button>
    <button wire:click="save" class="btn btn-primary mt-2">Enregistrer</button>
</div>
