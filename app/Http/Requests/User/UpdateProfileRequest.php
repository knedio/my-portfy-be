<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'location' => 'nullable|string|max:255',
            'profession_id' => 'sometimes|nullable|exists:professions,id',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => $this->input('firstName'),
            'last_name' => $this->input('lastName'),
            'email' => $this->input('email'),
            'location' => $this->input('location'),
            'profession_id' => $this->input('professionId'),
        ]);
    }
}
