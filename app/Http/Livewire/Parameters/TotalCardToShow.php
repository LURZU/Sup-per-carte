<?php

namespace App\Http\Livewire\Parameters;

use Livewire\Component;
use App\Models\User;

class TotalCardToShow extends Component
{
    public int $initial_total_card_toshow;
    public int $total_card_toshow;
    public $user;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->total_card_toshow = $this->user->total_card_toshow;
        $this->initial_total_card_toshow = $this->user->total_card_toshow;
    }

    public function save()
    {
        // mise à jour de l'attribut total_card_to_show de l'utilisateur
        $this->user->total_card_toshow = $this->total_card_toshow;
        $this->user->save();

        $this->emit('refresh');

        session()->flash('success', 'Les chapitres ont été enregistrés.');
    }

    public function increments() {
        $this->total_card_toshow++;
        $this->save();
    }

    public function decrements() {
        $this->total_card_toshow--;
        $this->save();
    }

    public function render()
    {
        return view('livewire.parameters.total-card-to-show');
    }
}
