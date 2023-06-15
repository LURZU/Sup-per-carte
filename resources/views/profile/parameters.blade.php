@extends('profile.base')

@section('title', 'Paramètres')

@section('active_parameters', 'active')

@section('content')

    <x-content.block title="{{'Nombre total de cartes'}}">
        <livewire:parameters.total-card-to-show :user="$user" />
    </x-content.block>

@endsection
