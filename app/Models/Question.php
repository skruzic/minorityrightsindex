<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

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

    protected $casts = [
        'conditions' => 'array',
        'extras' => 'array',
        'type' => 'integer',
        'parent_id' => 'integer',
    ];

    protected $touches = ['campaign'];

    public static function booted(): void
    {
        static::creating(function (Question $question) {
            $maxRgt = Question::where('campaign_id', $question->campaign_id)->max('rgt');

            if (! isset($question->attributes['lft'])) {
                $question->attributes['lft'] = $maxRgt + 1;
            }

            if (! isset($question->attributes['rgt'])) {
                $question->attributes['rgt'] = $maxRgt + 2;
            }

            if (! isset($question->attributes['parent_id'])) {
                $question->attributes['parent_id'] = 0;
            }
        });
    }

    public function optiongroup(): BelongsTo
    {
        return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    public function hasParent(): bool
    {
        return (int) $this->parent_id > 0;
    }

    public function scopeWithoutChildren($query)
    {
        return $query->where('parent_id', null);
    }
}
