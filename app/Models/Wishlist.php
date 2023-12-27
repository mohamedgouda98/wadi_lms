<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
