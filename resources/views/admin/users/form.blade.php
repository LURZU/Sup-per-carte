<!-- users/form.blade.php -->

@if($user->id)
    @if($user->hasRole('etudiant') || $user->hasRole('admin') )
        @livewire('admin.profil-select-option', ['user' => $user, 'matieresTab' => [1]])
    @else
        @livewire('admin.profil-select-option', ['user' => $user, 'matieresTab' => $matieres])
    @endif
@else 
    @livewire('admin.profil-select-option', ['user' => $user, 'matieresTab' => [1]])
@endif

