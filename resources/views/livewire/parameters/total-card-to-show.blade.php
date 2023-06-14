<div class="d-flex align-items-center flex-wrap">
    <label for="total_card_to_show" class="w-100">Nombre de cartes dans le deck</label>
{{--    <input wire:model="total_card_toshow" id="total_card_toshow" type="number" min="0" class="form-control">--}}


    <span class="fs-1 fw-bold w-100">{{ $initial_total_card_toshow }} cartes</span>
    <button wire:click="decrements" class="df-plus-minus-icon btn"><img src="{{ asset('icon/minus-circle-icon-dark.svg') }}" alt="Moins"></button>
    <span class="fs-1 fw-bold">{{ $total_card_toshow }}</span>
    <button wire:click="increments" class="df-plus-minus-icon btn"><img src="{{ asset('icon/plus-circle-icon-dark.svg') }}" alt="Plus"></button>

</div>
