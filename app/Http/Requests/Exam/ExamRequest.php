<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|min:3',
            'slug' => 'required|string|min:3',
            'degree' => 'required|numeric',
            'limit_questions' => 'required|integer',
            'active' => 'nullable',
            'close' => 'nullable',
            'specific_class' => 'nullable',
            'success_degree' => 'required|numeric',
            'failer_degree' => 'required|numeric',
            'class_id' => $this->checkClass()
        ];
    }

    protected function checkClass()
    {
        return request('specific_class') ? 'required|exists:classes,id' : 'nullable';
    }
}
