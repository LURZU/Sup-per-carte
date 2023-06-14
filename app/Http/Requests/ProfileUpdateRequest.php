<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['string', 'max:255'],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'formation_id' => 'required|integer',
            'school_id' => 'required|integer',
            'role_id' => 'required|string ',
            'formation_id' => 'integer',
            'matiere_id' => 'array',
        ];

        if ($this->method() === 'PUT') {
            // when updating, the email must be unique, but only for users other than the current user
            $rules['email'] = ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)];
           

        } else {
            // normal verification for new users
        
            $rules['email'] = ['email', 'max:255', Rule::unique(User::class)];

        }
        return $rules;
    }

    public function messages()
    {
    return [
    'email.unique' => 'L\'email existe déjà en base de donnée ',
    'category_id.numeric' => 'Invalid category value.',
    ];
    }

    public function prepareForValidation() { 
        $this->merge([
            'email' => $this->email,
            'role_id' => $this->role_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'school_id' => $this->school_id,
        ]);
    }
}
