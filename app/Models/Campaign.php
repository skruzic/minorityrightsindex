<?php

namespace App\Models;

use App\Helpers\PanelImporter;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Campaign extends Model
{
    use HasFactory, CrudTrait, Sluggable, SluggableScopeHelpers;

    protected $fillable = ['title', 'slug', 'description', 'locked', 'messages'];

    protected $fakeColumns = ['messages'];

    protected $casts = ['messages' => 'array'];

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('lft')->whereParentId(null);
        //return $this->hasMany(Question::class)->orderBy('lft')->whereDoesntHave('children');
    }

    public function responses()
    {
        return $this->hasManyThrough(Response::class, Invite::class);
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
