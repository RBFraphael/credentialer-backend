<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'client_id' => "numeric|exists:clients,id",
            'title' => "string|min:3",
        ];
    }

    public function messages()
    {
        return [
            'client_id.numeric' => __("The client ID must be a valid ID"),
            'client_id.exists' => __("The client ID must be a valid client ID"),
            'title.string' => __("The title must be a valid string"),
            'title.min' => __("The title must have at least 3 characters"),
        ];
    }
}
