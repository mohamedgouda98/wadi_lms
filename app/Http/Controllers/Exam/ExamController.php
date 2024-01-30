<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exam\ExamRequest;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    private $examModel;

    /**
     * @param Exam $examModel
     */
    public function __construct(Exam $examModel)
    {
        $this->examModel = $examModel;
    }

    public function index()
    {
        $exams = $this->examModel->paginate(20);
        return view('Exam.index', compact('exams'));
    }

    public function create(Course  $course)
    {
        return view('Exam.create', compact('course'));
    }

    public function store(ExamRequest  $request)
    {

        $this->examModel->create([
           'name' => $request->get('name'),
           'slug' => $request->get('name'),
           'degree' => $request->get('degree'),
           'limit_questions' => $request->get('limit_questions'),
           'active' => $request->has('active') ? 1 : 0,
           'close' => $request->has('close') ? 1 : 0,
           'course_id' => $request->get('course_id'),
        ]);

        toast(translate('success_add_exam'), 'success');
        return redirect(route('course.index'));
    }

    public function edit(Exam $exam)
    {
        return view('Exam.edit', compact('exam'));
    }

    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->update([
            'name' => $request->get('name'),
            'slug' => $request->get('name'),
            'degree' => $request->get('degree'),
            'limit_questions' => $request->get('limit_questions'),
            'active' => $request->has('active') ? 1 : 0,
            'close' => $request->has('close') ? 1 : 0,
        ]);

        toast(translate('success_update_exam'), 'success');
        return redirect(route('exam.index'));
    }
}
