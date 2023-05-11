<?php

namespace App\Http\Requests;

use App\Enums\CredentialType;
use Illuminate\Foundation\Http\FormRequest;

class CredentialCreateRequest extends FormRequest
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
        $types = CredentialType::cases();

        return [
            'project_id' => "required|numeric|exists:projects,id",
            'title' => "required|string|min:3",
            'type' => "required|in:".join(",", $types),
            'info' => "nullable|string",
            'gateway' => "required|string",
            'port' => "nullable|string",
            'user' => "required|string",
            'password' => "nullable|string",
            'files' => "nullable|array",
            'files.*' => "required|numeric|exists:files,id"
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => __("The project ID is required"),
            'project_id.numeric' => __("The project ID must be a valid ID"),
            'project_id.exists' => __("The project ID must be a valid project ID"),
            'title.required' => __("The title is required"),
            'title.string' => __("The title must be a string"),
            'title.min' => __("The title must have at least 3 characters"),
            'type.required' => __("The type is required"),
            'type.in' => __("The type must be a valid credential type"),
            'info.string' => __("The info must be a string"),
            'gateway.required' => __("The gateway is required"),
            'gateway.string' => __("The gateway must be a string"),
            'port.string' => __("The port must be a string"),
            'user.required' => __("The user is required"),
            'user.string' => __("The user must be a string"),
            'password.string' => __("The password must be a string"),
            'files.array' => __("The files must be an array"),
            'files.*.required' => __("The file ID is required"),
            'files.*.numeric' => __("The file ID must be a number"),
            'files.*.exists' => __("The file ID must be an existing file ID"),
        ];
    }
}
