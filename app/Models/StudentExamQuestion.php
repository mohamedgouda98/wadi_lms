<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentExamQuestion extends Model
{

    protected $fillable = ['student_exam_id', 'exam_question_id', 'degree', 'is_correct', 'answer'];

    public function studentExam(): BelongsTo
    {
        return $this->belongsTo(StudentExam::class, 'student_exam_id');
    }

    public function examQuestion()
    {
        return $this->belongsTo(ExamQuestion::class, 'exam_question_id');
    }
}
