<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Section extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['title', 'description', 'campaign_id'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
