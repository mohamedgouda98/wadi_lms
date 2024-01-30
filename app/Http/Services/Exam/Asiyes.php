<?php

namespace App\Http\Services\Exam;

use App\Http\Traits\ExamTrait;
use App\Models\ExamQuestion;
use App\Models\StudentExam;
use App\Models\StudentExamQuestion;
use RealRashid\SweetAlert\Facades\Alert;

class Asiyes
{
    use ExamTrait;

    public function getExamQuestions($args)
    {
        $exam = $args['exam'];
        return ExamQuestion::where('exam_id', $exam->id)->where('active', 1)->inRandomOrder()->limit($exam->limit_questions)->get();
    }

    public function submitExam($args)
    {
        $studentExam = $args['studentExam'];
        $userQuestionAnswers = $args['data']['questions'];
        $questionsIDS = array_keys($userQuestionAnswers);

        $examQuestions = ExamQuestion::whereIn('id',$questionsIDS)->with('answers')->get();
        $data = [];
        foreach($examQuestions as $examQuestion)
        {
            $data []= [
                'student_exam_id' => $studentExam->id,
                'question_id' => $examQuestion->id,
                'status' => 0,
                'degree' => 0,
                'is_correct' => 0,
                'answer' => $userQuestionAnswers[$examQuestion->id] ?? ''
            ];
        }

        StudentExamQuestion::insert($data);

        $studentExam->update([
            'status' => 1,
            'end_time' => now()
        ]);

        Alert::toast('Your Exam Was Submitted', 'success');
        return redirect(route('endUser.exam.index'));
    }

    public function teacherMark($args)
    {
        $studentExamQuestionDegreesArray = $args['data']['degree'];
        $studentExamQuestionCorrectionsArray = $args['data']['correct'];

        $exam = StudentExamQuestion::find(array_key_first($studentExamQuestionCorrectionsArray))->exam;

        $totalDegree = 0;
        foreach($studentExamQuestionCorrectionsArray as $studentExamQuestionId => $isCorrect)
        {
            $totalDegree += $isCorrect ? $studentExamQuestionDegreesArray[$studentExamQuestionId] : 0;
            StudentExamQuestion::where('id',$studentExamQuestionId)->update([
                'is_correct' => $isCorrect,
                'degree' => $isCorrect ? $studentExamQuestionDegreesArray[$studentExamQuestionId] : 0
            ]);
        }

        StudentExam::find($args['data']['student_exam_id'])->update([
            'degree' => $totalDegree,
            'is_marked' => 1
        ]);

        Alert::toast('Exam Was Marked', 'success');
        return redirect(route('endUser.exam.show',$exam->id));
    }
}
