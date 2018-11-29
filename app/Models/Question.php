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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)->using(CampaignQuestion::class);
    }
}
