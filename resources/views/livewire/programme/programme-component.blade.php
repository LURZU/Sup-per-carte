<div>
    @section('display_title_h1', 'd-none')
<div class="container">
    <h1>Quizz</h1>
    
    @if(count($cards) > 0)
        @php
            $card = $cards[$currentCardIndex];
        @endphp
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Question: {{ $card['question'] }}</h5>
                <p class="card-text">Matière: {{ $card['matiere'] }}</p>
                <p class="card-text">Chapitre: {{ $card['chapitre'] }}</p>
                <p class="card-text">Niveau: {{ $card['level'] }}</p>
               
                @if($showResponse)
                <p class="card-text">Réponse: {{ $card['response'] }}</p>
                @endif
            </div>
        </div>
    @endif
    @if(!$showResponse)
    <button class="btn btn-primary" wire:click="showResponse">Reponse</button>
    @endif
    
    <div class="text-center">
        @if($currentCardIndex !== 0)
        <button wire:click="previousCard" class="btn btn-primary">Previous</button>
        @endif 
        @if($currentCardIndex < $number_cards  && $currentCard > $currentCardIndex)
        <button wire:click="nextCard" class="btn btn-primary">Next</button>
        @endif
    </div>
</div>
</div>
