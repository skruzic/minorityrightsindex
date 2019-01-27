<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use App\Enums\QuestionType;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $section_id
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string|null $title
 * @property int $type
 * @property string $question
 * @property string|null $panel
 * @property array|null $extras
 * @property int|null $option_group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $children
 * @property-read \App\Models\OptionGroup|null $options
 * @property-read \App\Models\Question|null $parent
 * @property-read \App\Models\Section $section
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereExtras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereOptionGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question wherePanel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question withoutChildren()
 * @mixin \Eloquent
 */
class Question extends Model
{
    use CrudTrait;

    protected $fillable = [
        'section_id',
        'parent_id',
        'type',
        'title',
        'question',
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
