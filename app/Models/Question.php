<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\QuestionType;

class Question extends Model
{
    protected $fillable = ['parent_id', 'type', 'question', 'option_group_id', 'order'];

    /*public function campaigns()
    {
        return $this->belongsToMany(Campaign::class)->using(CampaignQuestion::class);
    }*/

    /*public function type()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }*/

    public function options()
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    public function hasParent()
    {
        return count($this->parent) > 0;
    }

    /*
     * Scopes
     */

    public function scopeWithoutChildren($query)
    {
        return $query->where('parent_id', null);
    }

    /*public function getQuestionAttribute($value)
    {
        if ($this->attributes['type'] == 4) {
            return unserialize(base64_decode($value));
        }

        return $value;
    }

    public function setQuestionAttribute($value)
    {
        if ($this->attributes['type'] == 4) {
            $this->attributes['question'] = base64_encode(serialize($value));
        } else {
            $this->attributes['question'] = $value;
        }
    }*/

}
