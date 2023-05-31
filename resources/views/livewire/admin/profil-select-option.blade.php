
<div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
          

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        @if($user->id)
                      
                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Type de profil') }}</label>
                            <div class="col-md-6">
                               {{ $user->roles()->first()->name }}
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @else
                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Type de profil') }}</label>
                            <div class="col-md-6">
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input wire:model="selectedTypeProfil" wire:change="updateFormOption" class="form-check-input" type="radio" name="role_id" id="roles{{ $role->id }}" value="{{ $role->id }}" >
                                        <label class="form-check-label" for="roles{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Prénom</label>

                            <div class="col-md-6">
                                <input wire:model="firstname" id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $user->first_name) }}" required autocomplete="name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                            <div class="col-md-6">
                                <input wire:model="lastname" id="name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $user->last_name) }}" required autocomplete="name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input wire:model="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="card_level_id" class="col-md-4 col-form-label text-md-right">{{ __('école') }}</label>
                            <div class="col-md-6">
                                <select wire:model="schoolId" id="school_id" class="form-control @error('school_id') is-invalid @enderror" name="school_id">
                                    <option value="" disabled selected>école</option>
                                    @foreach ($schools as $school)
                                        <option value="{{ $school->id }}" {{ old('school_id', $school->id) == $school->id ? 'selected' : '' }}>{{ $school->label }}</option>
                                    @endforeach
                                </select>

                                @error('school_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($selectedTypeProfil == 3)
                            <div class="form-group row">
                                <label for="formation_id" class="col-md-4 col-form-label text-md-right">{{ __('Formations') }}</label>
                                <div class="col-md-6">
                                    <select id="formation_id" class="form-control @error('formation_id') is-invalid @enderror" name="formation_id">
                                        <option value="" disabled selected>école</option>
                                        @foreach ($formations as $formation)
                                            <option value="{{ $formation->id }}" {{ old('formation_id', $formation->id) == $formation->id ? 'selected' : '' }}>{{ $formation->label }}</option>
                                        @endforeach
                                    </select>

                                    @error('formation_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @elseif($selectedTypeProfil == 2)
                            <div class="form-group row">
                                <label for="matiere_id" class="col-md-4 col-form-label text-md-right">{{ __('Matières') }}</label>
                                <div class="col-md-6">
                                    <select wire:model="matiereId" id="matiere_id" class="form-control @error('matiere_id') is-invalid @enderror" name="matiere_id[]" multiple required>
                                        <option value="" disabled selected>école</option>
                                        @foreach ($matieres as $matiere)
                                            <option value="{{ $matiere->id }}" {{ old('matiere_id', $matiere->id) == $matiere->id ? 'selected' : '' }}>{{ $matiere->label }}</option>
                                        @endforeach
                                    </select>

                                    @error('matiere_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <!-- Ajoutez d'autres champs du formulaire selon vos besoins -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @if($user->id)
                                    {{ __('Modifier') }}
                                    @else
                                    {{ __('Créer') }}
                                    @endif
                                </button>
                                <button href="{{route('admin.profil.index')}}" class="btn btn-secondary">
                                    {{ __('Annuler') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
