<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'degree', 'exam_type', 'active', 'close', 'limit_questions', 'auto_answer',
        'course_id','specific_class', 'class_id', 'success_degree', 'failer_degree', 'class_content_id'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function classContent(): BelongsTo
    {
        return $this->belongsTo(ClassContent::class, 'class_content_id', 'id');
    }
}
