
<div>
<div class="">
    <div class="row justify-content-center">

            <div class="card border-0">
          

                <div class="card-body w-100 border-0">
                    <form method="POST" action="">
                        @csrf
                        @if($user->id)
                      
                        <div class="form-group row">
                            <h3 for="role_id" class="fs-5 mb-3" >{{ __('Type de profil') }}</h3>
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
                            <h3 for="role_id" class="fs-5 mb-3">{{ __('Type de profil') }}</h3>
                            <div class="col-md-6">
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline me-5">
                                        <input wire:model="selectedTypeProfil" wire:change="updateFormOption" class="form-check-input radio-input" type="radio" name="role_id" id="roles{{ $role->id }}" value="{{ $role->id }}" >
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
                        <h3 class="fs-5 mt-4 mb-4">Infos étudiant</h3>
                        <div class="form-group row mt-1">
                            <label for="name" class="mb-2">Prénom</label>

                            <div class="col-md-6">
                                <input wire:model="firstname" id="name" type="text" class="form-control light-grey-background @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $user->first_name) }}" required autocomplete="name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="name" class="mb-2">Nom</label>

                            <div class="col-md-6">
                                <input wire:model="lastname" id="name" type="text" class="form-control light-grey-background @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $user->last_name) }}" required autocomplete="name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="email" class="mb-2">Email</label>

                            <div class="col-md-6">
                                <input wire:model="email" id="email" type="email" class="form-control light-grey-background @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row mt-3">
                            <label for="school_id" class="mb-2">{{ __('école') }}</label>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <select wire:model="schoolId" id="school_id" class="custom-select w-100 h-100 rounded p-2 light-grey-background select @error('school_id') is-invalid @enderror" name="school_id">
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
                        </div>
                        
                        

                        @if($selectedTypeProfil == 3)
                            <div class="form-group row mt-2">
                                <label for="formation_id" class="mb-2">{{ __('Formations') }}</label>
                                <div class="col-md-6">
                                    <select id="formation_id" class="custom-select w-100 h-100 rounded p-2 light-grey-background select @error('formation_id') is-invalid @enderror" name="formation_id">
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
                            <div class="form-group row mt-3">
                                <label for="matiere_id" class="mb-2">{{ __('Matières') }}</label>
                                <div class="col-md-6">
                                    <select wire:model="matiereId" id="matiere_id" class="form-control light-grey-background @error('matiere_id') is-invalid @enderror" name="matiere_id[]" multiple required>
                                        <option value="" disabled hidden selected>école</option>
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
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #333333; border-color: #333333;">
                                    @if($user->id)
                                    {{ __('Modifier') }}
                                    @else
                                    {{ __('Créer un profil') }}
                                    <i class="fa-solid fa-chevron-right fa-2xs ms-2"></i>
                                    @endif
                                </button>
                                <button wire:click="redirect_index" class="btn btn-secondary">
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
