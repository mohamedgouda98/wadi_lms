<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Services\Exam\ExamService;
use App\Models\ExamQuestion;
use App\Models\Question;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    private $questionAnswerModel;
    private $examService;

    /**
     * @param QuestionAnswer $answerModel
     * @param ExamService $examService
     */
    public function __construct(QuestionAnswer $answerModel, ExamService $examService)
    {
        $this->questionAnswerModel = $answerModel;
        $this->examService = $examService;
    }

    public function create(ExamQuestion $question)
    {
        return view('QuestionAnswer.create', compact('question'));
    }

    public function store(Request $request)
    {
        return $this->examService->run('createQuestionAnswer',[
            'type' => $request->exam_type,
            'data' => $request->all()
        ]);
    }

    public function makeCorrect(QuestionAnswer $questionAnswer = null)
    {
        $otherAnswersQuery = $this->questionAnswerModel::where('exam_question_id',$questionAnswer->exam_question_id)
            ->where('id',$questionAnswer->id)->first();

        $otherAnswersQuery->update([
            'correct' => !$otherAnswersQuery->correct
        ]);


        toast('Answer Made Correct Successfully', 'success');
        return back();
    }


    public function updateAnswer(Request $request)
    {
        $questionAnswer = $this->questionAnswerModel->findOrFail($request->id);

        $questionAnswer->update([
            'answer' => $request->answer
        ]);
        return response()->json([
            'status' => 200
        ]);
    }

    public function destroy(QuestionAnswer $questionAnswer)
    {
        if($questionAnswer->correct == 1)
        {
            toast("Can't Delete The Correct Answer", 'warning');
            return back();
        }
        $questionAnswer->delete();
        toast('Answer Deleted Successfully', 'success');
        return back();
    }
}
