<?php

namespace App\Models;

use App\Helpers\AnswerExporter;
use App\Helpers\PanelImporter;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use CrudTrait, Sluggable;

    protected $fillable = ['title', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /*public function questions()
    {
        return $this->belongsToMany(Question::class)->using(CampaignQuestion::class)->withPivot(['id', 'order']);
    }*/

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('sections.lft');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function sluggable(): array
    {
        // TODO: Implement sluggable() method.
        return [
            'slug' => [
                'source'=>'title'
            ]
        ];
    }


}
