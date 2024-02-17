<?php

namespace App\Http\Controllers\StudentExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\StudentAnswerRequest;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\QuestionAnswer;
use App\Models\SeenContent;
use App\Models\Student;
use App\Models\StudentExam;
use App\Models\StudentExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentExamController extends Controller
{
    public function courseExam(Course $course)
    {
        $exams = Exam::where('course_id', $course->id)->get();
        return view('frontend.StudentExam.index', compact('exams'));
    }

    public function questions(Exam $exam)
    {
        $questions = ExamQuestion::where(['exam_id' => $exam->id, 'active' => 1])
            ->inRandomOrder()->limit($exam->limit_questions)->get();
        $studentExam = StudentExam::where('student_id', auth()->user()->student->id)
            ->where('exam_id', $exam->id)
            ->where('is_marked', 1)
            ->first();

        $seenContents = SeenContent::where('user_id', auth()->id())
            ->where('course_id', $exam->course_id)
            ->count();
        $seenContentByClass = SeenContent::where('user_id', auth()->id())
            ->where('course_id', $exam->course_id)
            ->groupBy('class_id')
            ->count();
        dd(auth()->user()->seenContents);
        if (($exam->specific_class && $seenContentByClass < count($exam->course->classes)) || (! $exam->specific_class && $seenContents < count($exam->course->classes))){
            alert()->error('You must finish the content before taking the exam');
            return redirect()->route('course.single', $exam->course->slug);
        }
        return view('frontend.StudentExam.exam', compact('questions', 'exam', 'studentExam'));
    }

    public function storeStudentAnswers(StudentAnswerRequest $request)
    {
        $examId = $request->exam_id;
        $studentId = Student::where('user_id', auth()->id())->first()->id; // Assuming the student is the authenticated user
        $answers = $request->answers; // Associative array: exam_question_id => submitted_answer

        // Begin a transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Assuming you have a model StudentExam
            $studentExam = new StudentExam([
                'exam_id' => $examId,
                'student_id' => $studentId,
                'degree' => 0, // Temporary, will update after scoring
            ]);
            $studentExam->save();

            $totalScore = 0;
            foreach ($answers as $questionId => $submittedAnswer) {
                // Fetch the correct answer(s) for the question
                $correctAnswers = QuestionAnswer::where('exam_question_id', $questionId)
                    ->where('correct', 1)
                    ->get();

                $isCorrect = 0;
                $degree = 0;


                foreach ($correctAnswers as $correctAnswer) {
                    if ($correctAnswer->id == $submittedAnswer || $correctAnswer->answer == $submittedAnswer) {
                        $isCorrect = 1;
                        $degree = 1;
                        break;
                    }
                }

                $totalScore += $degree;
                $studentAnswer = QuestionAnswer::where('id', $submittedAnswer)->first();
                // Record the student's answer
                $studentExamQuestion = new StudentExamQuestion([
                    'student_exam_id' => $studentExam->id,
                    'exam_question_id' => $questionId,
                    'degree' => $degree,
                    'is_correct' => $isCorrect,
                    'answer' => $studentAnswer->answer, // Adjust if you're saving ID vs text
                ]);
                $studentExamQuestion->save();
            }

            // Update the student's exam score
            $studentExam->degree = $totalScore;
            $studentExam->is_marked = 1; // Assuming marking is done here
            $studentExam->save();

            DB::commit();
            alert()->success( 'Exam submitted successfully, Degree Is'. $totalScore);
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            alert()->error('Failed Adding Answers');
            return back();
        }
    }
}
