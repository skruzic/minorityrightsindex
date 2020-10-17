<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invite()
    {
        return $this->belongsTo(Invite::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
