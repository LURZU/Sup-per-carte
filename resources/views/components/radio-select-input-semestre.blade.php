<div class="form-group row">
    <label for="card_semestre_id" class="col-md-4 col-form-label text-md-right">{{ __('Semestre') }}</label>
    <div class="col-md-6">
        @foreach ($semestres as $semestre)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="card_semestre_id" id="semestre{{ $semestre->id }}" value="{{ $semestre->id }}" {{ $card->card_semestre_id == $semestre->id ? 'checked' : '' }}>
                <label class="form-check-label" for="semestre{{ $semestre->id }}">{{ $semestre->label }}</label>
            </div>
        @endforeach
        @error('card_semestre_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
