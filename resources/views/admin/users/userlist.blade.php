@extends('admin.base')

@section('content')
    
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @livewire('admin.filter-profil', ['users_role' => $users_role])
@endsection
