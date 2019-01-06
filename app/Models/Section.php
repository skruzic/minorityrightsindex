<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use CrudTrait;

    protected $fillable = ['title', 'description', 'campaign_id', 'order'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
