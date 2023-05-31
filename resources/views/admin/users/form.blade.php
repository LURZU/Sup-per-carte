<!-- users/form.blade.php -->

@if($user->hasRole('student') || $user->hasRole('admin') )
@livewire('admin.profil-select-option', ['user' => $user, 'matieresTab' => [1]])
@else
@livewire('admin.profil-select-option', ['user' => $user, 'matieresTab' => $matieres])
@endif

