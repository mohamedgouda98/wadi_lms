<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'exam_id' => 'required|exists:exams,id',
            'question' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'active' => 'nullable'
        ];
    }
}
