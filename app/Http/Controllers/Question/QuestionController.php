<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exam\QuestionRequest;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $examQuestionModel;

    /**
     * @param ExamQuestion $examQuestionModel
     */
    public function __construct(ExamQuestion $examQuestionModel)
    {
        $this->examQuestionModel = $examQuestionModel;
    }

    public function index()
    {
        $questions = $this->examQuestionModel::with('exam')->paginate(20);
        return view('Question.index', compact('questions'));
    }
    public function create(Exam $exam)
    {
        return view('Question.create', compact('exam'));
    }

    public function store(QuestionRequest $request)
    {
        $fileName = $request->hasFile('image') ? fileUpload($request->image, 'question') : null;
        $this->examQuestionModel->create([
            'exam_id' => $request->exam_id,
            'question' => $request->question,
            'question_image' => $fileName,
            'active' => $request->has('active') ? 1 : 0,
        ]);
        toast(translate('success_add_question'), 'success');
        return redirect(route('exam.index'));
    }

    public function edit(ExamQuestion $examQuestion)
    {
        return view('Question.edit', compact('examQuestion'));
    }

    public function update(QuestionRequest $request, ExamQuestion $examQuestion)
    {
        $fileName = $request->hasFile('image') ? fileUpload($request->image, 'question') : $examQuestion->question_image;
        $examQuestion->update([
            'exam_id' => $request->exam_id,
            'question' => $request->question,
            'question_image' => $fileName,
            'active' => $request->has('active') ? 1 : 0,
        ]);
        toast(translate('success_update_question'), 'success');
        return redirect(route('question.index'));
    }

    public function delete($questionId)
    {
        $question = $this->examQuestionModel->findOrFail($questionId);
        $question->delete();
        if ($question->question_image){
            fileDelete($question->question_image);
        }

        toast(translate('success_delete_question'), 'success');
        return back();
    }
}
