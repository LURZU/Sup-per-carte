@extends('student.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New Card') }}</div>

                    <div class="card-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

                                <div class="col-md-6">
                                    <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required autofocus>

                                    @error('question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="response" class="col-md-4 col-form-label text-md-right">{{ __('Response') }}</label>

                                <div class="col-md-6">
                                    <input id="response" type="text" class="form-control @error('response') is-invalid @enderror" name="response" value="{{ old('response') }}" required>

                                    @error('response')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                                <div class="col-md-6">
                                    <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                                        <option value="" disabled selected>Selectionner un level</option>
                                        @foreach ($cardLevels as $level)
                                            <option value="{{ $level->id }}" {{ old('level') == $level->id ? 'selected' : '' }}>{{ $level->label }}</option>
                                        @endforeach
                                    </select>

                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="matiere" class="col-md-4 col-form-label text-md-right">{{ __('Matiere') }}</label>
                                <div class="col-md-6">
                                    <select id="chapitre" class="form-control @error('matiere') is-invalid @enderror" name="matiere" required>
                                        <option value="" disabled selected>Selectionner une matière</option>
                                        @foreach ($matieres as $matiere)
                                            <option value="{{ $matiere->id }}" {{ old('matiere') == $matiere->id ? 'selected' : '' }}>{{ $matiere->label }}</option>
                                        @endforeach
                                    </select>

                                    @error('matiere')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="semestre" class="col-md-4 col-form-label text-md-right">{{ __('Semestre') }}</label>
                                <div class="col-md-6">
                                    <select id="semestre" class="form-control @error('semestre') is-invalid @enderror" name="semestre" required>
                                        <option value="" disabled selected>Select a semestre</option>
                                        @foreach ($semestres as $semestre)
                                            <option value="{{ $semestre->id }}" {{ old('semestre') == $matiere->id ? 'selected' : '' }}>{{ $semestre->label }}</option>
                                        @endforeach
                                    </select>

                                    @error('semestre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
