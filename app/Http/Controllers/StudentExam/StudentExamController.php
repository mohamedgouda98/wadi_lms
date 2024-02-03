<?php

namespace App\Http\Controllers\StudentExam;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function courseExam(Course $course)
    {
        $exams = Exam::where('course_id', $course->id)->get();
        return view('frontend.StudentExam.index', compact('exams'));
    }

    public function questions(Exam $exam)
    {
        $questions = ExamQuestion::where(['exam_id' => $exam->id, 'active' => 1])->get();
        return view('frontend.StudentExam.exam', compact('questions'));
    }
}
