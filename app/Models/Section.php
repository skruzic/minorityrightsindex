<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Section
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $title
 * @property string|null $description
 * @property int $campaign_id
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Section extends Model
{
    use CrudTrait;

    protected $fillable = ['title', 'description', 'campaign_id', 'order'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
