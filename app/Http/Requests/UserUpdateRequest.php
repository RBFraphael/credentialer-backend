<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $roles = UserRole::cases();
        $userId = request()->id;

        return [
            'name' => "string|min:3",
            'email' => ["email", Rule::unique("users", "email")->ignore($userId, "id")],
            'password' => "string|min:8",
            'role' => "in:".join(",", $roles),
        ];
    }

    public function messages()
    {
        return [
            'name.string' => __("The name must be a valid string"),
            'name.min' => __("The name must have at least 3 characters"),
            'email.email' => __("The email must be a valid email address"),
            'email.unique' => __("The email is already registered"),
            'password.string' => __("The password must be a valid string"),
            'password.min' => __("The password must have at least 8 characters"),
            'role.in' => __("The role must be a valid user role"),
        ];
    }
}
