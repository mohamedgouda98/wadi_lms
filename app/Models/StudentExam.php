<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    protected $fillable = ['exam_id', 'student_id', 'degree', 'auto_answer', 'is_marked'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
