<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;
    const PATH = 'questions';
    protected $fillable = ['exam_id', 'question', 'question_image', 'active'];

    protected function getQuestionImageAttribute($value)
    {
        return config('app.url') . self::PATH.DIRECTORY_SEPARATOR. $value;
    }


}
