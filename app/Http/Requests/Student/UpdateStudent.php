<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . request()->student_id,
            'phone' => 'nullable',
            'address' => 'nullable',
            'fb' => 'nullable|url',
            'tw' => 'nullable|url',
            'linked' => 'nullable|url',
        ];
    }
}
