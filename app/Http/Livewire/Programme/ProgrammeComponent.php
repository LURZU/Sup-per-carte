<?php

namespace App\Http\Livewire\Programme;

use Livewire\Component;

class ProgrammeComponent extends Component
{
    public $cards;
    public $card;
    public $number_cards;
    public $currentCardIndex = 0;
    public $currentCard = 0;
    public $showResponse = false;

    public function mount($cards, $number_cards) {
        $this->cards = $cards;
        $this->number_cards = $number_cards;

    }

    public function showResponse() {
        $this->currentCard++;
        $this->showResponse = true;
    }

    public function nextCard() {
        $this->showResponse = false;
        if ($this->currentCardIndex < count($this->cards) - 1) {
            $this->currentCardIndex++;
            
        }
    }

    public function previousCard() {
        if ($this->currentCardIndex > 0) {
            $this->currentCardIndex--;
        }
    }

    public function render() {
        return view('livewire.programme.programme-component');
    }
}
