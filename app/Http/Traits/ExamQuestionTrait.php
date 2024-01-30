<?php

namespace App\Http\Traits;

use App\Models\QuestionAnswer;
use Illuminate\Database\Eloquent\Model;

trait ExamQuestionTrait
{
    /**
     * accepts examQuestion model or Id
     *
     * @param int $question ,Model $question
     * @return bool
     */
    private function questionHasAnswers($question)
    {
        $id = $question;
        if($question instanceof Model)
        {
            $id = $question->id;
        }
        return QuestionAnswer::where('exam_question_id',$id)->count() > 0;
    }

    /**
     * accepts examQuestion model or Id
     *
     * @param int $question ,Model $question
     * @return bool
     */
    private function questionHasOneRightAnswer($question)
    {
        $id = $question;
        if($question instanceof Model)
        {
            $id = $question->id;
        }
        return QuestionAnswer::where('exam_question_id',$id)->where('correct',1)->count() > 0;
    }
}
