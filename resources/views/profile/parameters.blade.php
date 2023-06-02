@extends('profile.base')

@section('title', 'Paramètres')

@section('content')
<div>
    <h3>Paramètres</h3>
    @livewire('parameters.total-card-to-show', ['user' => $user])
   
</div>
@endsection
