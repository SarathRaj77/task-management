<?php

namespace App\Http\Requests;

use App\Traits\ValidatorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    use ValidatorResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|unique:tasks',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date_format:Y-m-d H:i:s|after:now',
        ];
    }
}
