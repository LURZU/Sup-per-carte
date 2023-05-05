<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
            'question ' => 'required|string',
            'response' => 'required|string',
            'public' => 'required|boolean',
            'card_chapitre' => 'required|integer',
            'card_level_id' => 'required|integer',
            'card_semestre_id' => 'required|integer',
            'created_by' => 'required|string',
            'validated_by' => 'required|string',
        ];
    }

    public function prepareForValidation() { 
        $this->merge([
            'question' => $this->question,
            'response' => $this->response,
            'public' => $this->public,
            'card_chapitre' => $this->card_chapitre,
            'card_level_id' => $this->card_level_id,
            'card_semestre_id' => $this->card_semestre_id,
            'created_by' => $this->created_by,
            'validated_by' => $this->validated_by,
        ]);
    }
}
