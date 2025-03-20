<?php

namespace App\Http\Requests;

use App\Traits\ValidatorResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class GetTaskRequest extends FormRequest
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
            'order' => 'nullable|in:asc,desc',
            'status' => 'nullable|in:pending,completed,expired',
            'user_ids' => 'nullable|array',
            'user_ids.*' => 'exists:users,id',
        ];
    }
}
