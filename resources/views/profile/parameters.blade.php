@extends('profile.base')

@section('title', 'Paramètres')

@section('active_parameters', 'active')

@section('content')
<div>
    <h3>Paramètres</h3>
    @livewire('parameters.total-card-to-show', ['user' => $user])
   
</div>
@endsection
