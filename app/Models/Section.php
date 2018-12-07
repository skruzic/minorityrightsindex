<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['campaign_id', 'order'];

    public function questions()
    {
        return $this->belongsToMany(Question::class,
            'section_questions')->using(SectionQuestion::class)->withPivot(['id', 'order']);
    }
}
