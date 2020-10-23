<?php

namespace App\Models;

use App\Helpers\AnswerExporter;
use App\Helpers\PanelImporter;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Campaign extends Model
{
    use HasFactory, CrudTrait, Sluggable, SluggableScopeHelpers;

    protected $fillable = ['title', 'slug', 'description', 'access_type'];

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('lft')->whereParentId(null);
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

    /*public function getRouteKeyName()
    {
        return 'slug';
    }*/
}
