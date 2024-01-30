<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait ExamTrait
{
    private function calculateDegreeForEachQuestion($exam)
    {
        return round($exam->degree / $exam->limit_questions,2);
    }
}
