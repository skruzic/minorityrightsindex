<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\QuestionType;

class Question extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'section_id',
        'parent_id',
        'type',
        'code',
        'text',
        'panel',
        'extras',
        'option_group_id',
    ];

    protected $fakeColumns = ['extras'];

    protected $casts = ['extras' => 'array'];

    /*
     * Relationships
     */

    public function options()
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
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

    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    public function hasParent()
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
