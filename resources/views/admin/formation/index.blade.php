@extends('admin.base')
@section('content')
@livewire('admin.formation-list', ['formations' => $formations])
@endsection