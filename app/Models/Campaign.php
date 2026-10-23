<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Campaign extends Model
{
    use HasFactory, Sluggable, SluggableScopeHelpers;

    protected $fillable = ['title', 'slug', 'description', 'locked', 'messages'];

    protected $casts = [
        'messages' => 'array',
        'locked' => 'boolean',
    ];

    public function invites(): HasMany
    {
        return $this->hasMany(Invite::class);
    }

    /**
     * Top-level questions only (used by the public API and clone).
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('lft')->whereParentId(0);
    }

    /**
     * Every question in the campaign, including nested Likert children.
     */
    public function allQuestions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('lft');
    }

    public function leaves(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('lft')->whereRaw('lft = rgt-1');
    }

    public function responses(): HasManyThrough
    {
        return $this->hasManyThrough(Response::class, Invite::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
