<?php

namespace App\Models;

use App\Helpers\AnswerExporter;
use App\Helpers\PanelImporter;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Campaign extends Model
{
    use HasFactory, CrudTrait, Sluggable;

    protected $fillable = ['title', 'slug', 'description'];

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

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
                'source' => 'title',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
