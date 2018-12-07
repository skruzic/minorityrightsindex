<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['type', 'questions', 'options'];

    protected $casts = [
        'questions' => 'array',
        'options'   => 'array',
    ];

    /*public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)->using(CampaignQuestion::class);
    }*/

    public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }

    public function options()
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }

}
