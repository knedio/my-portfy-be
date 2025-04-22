<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => "sometimes|required|string|email|max:255|unique:users,email,{$userId}",
            'password' => 'sometimes|nullable|string|min:6',
            'template_id' => 'sometimes|nullable|exists:templates,id',
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
