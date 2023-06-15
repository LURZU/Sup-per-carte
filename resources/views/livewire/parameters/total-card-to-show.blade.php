<div>
        <div class="fs-30 fw-bold w-100 mb-2">{{ $initial_total_card_toshow }} <span class="fs-3 fw-normal">cartes</span></div>
        <div class="mb-3">
            <div class="d-block">
                Limiter le nombre de cartes dans le paquet
            </div>
            <div class="d-flex align-content-center">
                <button wire:click="decrements" class="df-plus-minus-icon btn p-0"><img src="{{ asset('icon/minus-circle-icon-dark.svg') }}" alt="Moins"></button>
                <span class="fs-30 fw-bold mx-3">{{ $total_card_toshow }}</span>
                <button wire:click="increments" class="df-plus-minus-icon btn p-0"><img src="{{ asset('icon/plus-circle-icon-dark.svg') }}" alt="Plus"></button>
            </div>
        </div>
        <div>
            <a href="#" class="df-block-link">Modifier les cartes créées</a>
        </div>
</div>
