
@extends('student.base')
@section('title', 'Sup\'percarte Programme révision')
@section('content')
@livewire('programme.programme-component', ['cards' => $cards, 'number_cards' => $number_card])
@endsection