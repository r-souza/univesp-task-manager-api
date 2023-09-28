<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'priority_id'   => 'required|exists:priorities,id',
            'project_id'    => 'required|exists:projects,id',
            'status_id'     => 'required|exists:statuses,id',
            'user_id'       => 'required|exists:users,id'
        ];
    }
}
