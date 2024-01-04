<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    //

    protected $guarded = ['id'];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function pages()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }

    protected $casts = [
        'json' => 'array',
    ];
}
