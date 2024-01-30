<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamQuestion extends Model
{
    use HasFactory;
    const PATH = 'questions';
    protected $fillable = ['exam_id', 'question', 'question_image', 'active'];

    protected function getQuestionImageAttribute($value)
    {
        return config('app.url') . self::PATH.DIRECTORY_SEPARATOR. $value;
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuestionAnswer::class, 'exam_question_id');
    }


}
