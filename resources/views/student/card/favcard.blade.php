@extends('student.base')

@section('content')
@section('title', 'Mes cartes favorites')
@section('active_card', 'nuan')
@section('active_favcard', 'active')
    @include('student.card.list')
@endsection