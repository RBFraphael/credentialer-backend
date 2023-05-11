<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => "required|email|exists:users,email",
            'password' => "required"
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __("The email is required"),
            'email.email' => __("The email must be a valid email address"),
            'email.exists' => __("The provided email isn't registered"),
            'password.required' => __("The password is required"),
        ];
    }
}
