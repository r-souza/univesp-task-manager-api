<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'name'          => 'required|min:3|max:255',
            'description'   => 'nullable|min:3|max:255',
            'priority_id'   => 'sometimes|required|exists:priorities,id',
            'project_id'    => 'sometimes|required|exists:projects,id',
            'status_id'     => 'sometimes|required|exists:statuses,id',
        ];
    }
}
