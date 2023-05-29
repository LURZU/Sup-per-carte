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
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'formation_id' => 'required|integer',
            'school_id' => 'required|integer',
            'role_id' => 'required|string ',
        ];
    }

    public function prepareForValidation() { 
        $this->merge([
            'email' => $this->email,
            'role_id' => $this->role_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'school_id' => $this->school_id,
            'formation_id' => $this->formation_id,
        ]);
    }
}
