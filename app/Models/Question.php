<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'campaign_id',
        'parent_id',
        'type',
        'code',
        'text',
        'panel',
        'conditions',
        'extras',
        'option_group_id',
    ];

    protected $fakeColumns = ['extras'];

    protected $casts = ['conditions' => 'array', 'extras' => 'array'];

    protected $touches = ['campaign'];

    public static function booted()
    {
        static::creating(function ($question) {
            $maxRgt = Question::where('campaign_id', $question->campaign_id)->max('rgt');

            if ( ! isset($question->attributes['lft'])) {
                $question->attributes['lft'] = $maxRgt + 1;
            }

            if ( ! isset($question->attributes['rgt'])) {
                $question->attributes['rgt'] = $maxRgt + 2;
            }

        });
    }

    /*
     * Relationships
     */

    public function optiongroup()
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }

    public function hasParent(): bool
    {
        return count($this->parent) > 0;
    }

    public function withChildren()
    {
        return $this->children()->union($this);
    }

    /*
     * Scopes
     */

    public function scopeWithoutChildren($query)
    {
        return $query->where('parent_id', null);
    }
}
