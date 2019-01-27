<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Campaign
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Section[] $sections
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Campaign whereUserId($value)
 * @mixin \Eloquent
 */
class Campaign extends Model
{
    use CrudTrait;

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
        return $this->hasMany(Section::class)->orderBy('sections.order');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
