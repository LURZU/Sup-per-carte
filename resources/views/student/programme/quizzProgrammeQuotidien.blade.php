
   @extends('student.base')
   @section('title', 'Sup\'percarte Programme révision')
   @section('display_title_h1', 'd-none')
   @section('content')
   @livewire('programme.programme-component', ['cards' => $cards, 'number_cards' => $number_card])
   @endsection