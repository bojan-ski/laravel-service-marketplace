<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenProjectRequest extends FormRequest
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
            'title' => 'required|string|max:64',
            'description' => 'required|string|max:5000',
            'requirements' => 'required|string|max:3000',
            'budget_type' => 'required|string|in:fixed,hourly',
            'budget_amount' => 'nullable|numeric|min:0',
            'hour_price' => 'nullable|numeric|min:0',
            'deadline' => 'required|string',
            'document_path' => 'nullable|file|mimes:pdf,doc,docx|max:1024'
        ];
    }
}
