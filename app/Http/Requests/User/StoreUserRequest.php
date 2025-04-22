<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'template_id' => 'nullable|exists:templates,id',
            'about' => 'sometimes|array',
            'about.title' => 'required_with:about|string|max:255',
            'about.description' => 'required_with:about|string',
            'about.image' => 'nullable|string',

            'banner' => 'sometimes|array',
            'banner.title' => 'required_with:banner|string|max:255',
            'banner.description' => 'required_with:banner|string',
            'banner.btn_label' => 'nullable|string',
        ];
    }
}
