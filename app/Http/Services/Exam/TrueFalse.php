<?php

namespace App\Http\Services\Exam;

use App\Http\Traits\ExamQuestionTrait;
use App\Http\Traits\ExamTrait;
use App\Models\ExamQuestion;
use App\Models\QuestionAnswer;
use App\Models\StudentExam;
use App\Models\StudentExamQuestion;
use RealRashid\SweetAlert\Facades\Alert;

class TrueFalse
{
    use ExamQuestionTrait;
    use ExamTrait;

    public function createQuestionAnswer($args)
    {
        $data = $args['data'];

        $examQuestionId = $data['exam_question_id'];

        if(! $this->questionHasOneRightAnswer($examQuestionId))
        {
            ExamQuestion::where('id',$examQuestionId)->update([
                'active' => 1
            ]);
        }

        QuestionAnswer::updateOrCreate([
            'question_id' => $examQuestionId,
            'answer' => 'true'
        ],[
            'correct' => array_key_exists('trueIsCorrect',$data) ? 1 : 0
        ]);

        QuestionAnswer::updateOrCreate([
            'question_id' => $examQuestionId,
            'answer' => 'false'
        ],[
            'correct' => array_key_exists('falseIsCorrect',$data) ? 1 : 0
        ]);

        

        Alert::success('Answer Made Correct Successfully');
        return redirect()->back();
    }

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

        $degreeForEachQuestion = $studentExam->exam->degree / $studentExam->exam->limit_questions;

        $totalDegree = 0;
        $data = [];
        foreach($examQuestions as $examQuestion)
        {
            $answerIsCorrect = $this->AnswerIsCorrect($examQuestion, $userQuestionAnswers);

            $totalDegree += $answerIsCorrect ? $degreeForEachQuestion : 0;
            $data []= [
                'student_exam_id' => $studentExam->id,
                'question_id' => $examQuestion->id,
                'status' => 0,
                'degree' => $studentExam->auto_answer == 1 && $answerIsCorrect ? $degreeForEachQuestion : 0,
                'is_correct' => ($studentExam->auto_answer == 1) ? $answerIsCorrect : 0,
                'answer' => $userQuestionAnswers[$examQuestion->id] ?? '',
            ];
        }
        StudentExamQuestion::insert($data);

        $studentExam->update([
            'status' => 1,
            'degree' =>  $studentExam->auto_answer == 1 ? $totalDegree : 0,
            'is_marked' => ($studentExam->auto_answer == 1) ? 1 : 0     
        ]);

        Alert::toast('Your Exam Was Submitted', 'success');
        return redirect(route('endUser.exam.index'));
    }


    public function teacherMark($args)
    {
        $studentExamQuestionArray = $args['data']['correct'];

        $exam = StudentExamQuestion::find(array_key_first($studentExamQuestionArray))->exam;

        $degreeForEachQuestion = $this->calculateDegreeForEachQuestion($exam);

        $totalDegree = 0;
        foreach($studentExamQuestionArray as $studentExamQuestionId => $isCorrect)
        {
            $totalDegree += $isCorrect ? $degreeForEachQuestion : 0;
            StudentExamQuestion::where('id',$studentExamQuestionId)->update([
                'is_correct' => $isCorrect,
                'degree' => $isCorrect ? $degreeForEachQuestion : 0
            ]);
        }

        StudentExam::find($args['data']['student_exam_id'])->update([
            'degree' => $totalDegree,
            'is_marked' => 1
        ]);

        Alert::toast('Exam Was Marked', 'success');
        return redirect(route('endUser.exam.show',$exam->id));
    }

    private function AnswerIsCorrect($examQuestion,$userQuestionAnswers)
    {
        return $examQuestion->answers->where('answer',$userQuestionAnswers[$examQuestion->id])->where('correct',1)->count() > 0 ? 1 : 0;
    }
}
