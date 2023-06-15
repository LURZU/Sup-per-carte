@extends('profile.base')

@section('title', 'Paramètres')

@section('active_parameters', 'active')

@section('content')

    <x-content.block title="{{'Nombre total de cartes'}}">
        <livewire:parameters.total-card-to-show :user="$user" />
    </x-content.block>

    <x-content.block title="{{'Le paquet de cartes'}}">
{{--        TODO--}}
    </x-content.block>

    <x-content.block title="{{'Réglages système'}}">
        {{--        TODO--}}
    </x-content.block>

@endsection
