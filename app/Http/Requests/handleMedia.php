<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleMedia extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change this to true if authorization is not required for this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'media' => 'required|file|mimes:mp4,avi,mov', // Example: Allow only video files with extensions mp4, avi, and mov
            // Add any other validation rules as needed
        ];
    }
}
