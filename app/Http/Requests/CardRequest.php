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
        if(auth()->user()) {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'question' => 'required|string|min:8',
            'response' => 'required|string|min:8',
            'matiere_id' => 'required|integer',
            'formation_id' => 'integer',
            'public' => 'boolean',
            'card_chapitre_id' => 'required|integer',
            'card_level_id' => 'required|integer',
            'card_semestre_id' => 'required|integer',
            'created_by' => 'string',
            'validated_by' => 'string',
            'user_id' => 'integer',
            'question_img_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'response_img_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048',
        ];
    }

    public function messages(): array
    {
    return [
        'email.unique' => 'L\'email existe déjà en base de donnée ',
        'question.min' => 'La question doit contenir au moins 8 caractères',
        'response.min' => 'La réponse doit contenir au moins 8 caractères',
        'matiere_id.required' => 'La matière est obligatoire',
        'card_chapitre_id.required' => 'Le chapitre est obligatoire',
        'card_level_id.required' => 'Le niveau est obligatoire',
        'card_semestre_id.required' => 'Le semestre est obligatoire',
        'question_img_url.image' => 'Le fichier doit être une image',
        'response_img_url.image' => 'Le fichier doit être une image',
    ];
    }

    public function prepareForValidation(): void { 
        $this->merge([
            'question' => $this->question,
            'response' => $this->response,
            'matiere_id' => $this->matiere_id,
            'card_chapitre_id' => $this->card_chapitre_id,
            'card_level_id' => $this->card_level_id,
            'card_semestre_id' => $this->card_semestre_id,
        ]);
    }
}
