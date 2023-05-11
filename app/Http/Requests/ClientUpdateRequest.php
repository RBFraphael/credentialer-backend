<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
            'name' => "string|min:3",
            'logo_file_id' => "nullable|numeric|exists:files,id"
        ];
    }

    public function messages()
    {
        return [
            'name.string' => __("The name must be a valid string"),
            'name.min' => __("The name must have at least 3 characters"),
            'logo_file_id.numeric' => __("The logo file ID must be a valid ID"),
            'logo_file_id.exists' => __("The logo file ID must be a valid file ID"),
        ];
    }
}
