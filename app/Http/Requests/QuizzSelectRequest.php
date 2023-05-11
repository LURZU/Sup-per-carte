<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizzSelectRequest extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'matiere_id' => 'required|integer',
            'card_level_id' => 'required|integer',
            'card_chapitre' => 'required|array',
            'number_card' => 'required|integer'
        ];
    }

    public function prepareForValidation() { 
        $this->merge([
            'matiere_id' => $this->matiere_id,
            'card_chapitre' => $this->card_chapitre,
            'number_card' => $this->card_level_id,
            'card_level_id' => $this->card_level_id,
        ]);
    }
}
