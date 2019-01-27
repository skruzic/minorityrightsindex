<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['campaign_id', 'data'];

    public function campaign() {
        return $this->belongsTo(Campaign::class);
    }
}
