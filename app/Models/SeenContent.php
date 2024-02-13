<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeenContent extends Model
{
    protected $guarded = [];

    public function classContent()
    {
        return $this->belongsTo(ClassContent::class, 'class_content_id', 'id');
    }
}
