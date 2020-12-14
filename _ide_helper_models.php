<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Campaign
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property int $locked
 * @property array|null $messages
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invite[] $invites
 * @property-read int|null $invites_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $leaves
 * @property-read int|null $leaves_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Response[] $responses
 * @property-read int|null $responses_count
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign query()
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereMessages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campaign whereUpdatedAt($value)
 */
	class Campaign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invite
 *
 * @property int $id
 * @property int $campaign_id
 * @property string $email
 * @property string $token
 * @property int $page
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Response[] $responses
 * @property-read int|null $responses_count
 * @method static \Illuminate\Database\Eloquent\Builder|Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereUpdatedAt($value)
 */
	class Invite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OptionGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property array $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OptionGroup whereUpdatedAt($value)
 */
	class OptionGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $campaign_id
 * @property int|null $parent_id
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string|null $code
 * @property int $type
 * @property string $text
 * @property array|null $conditions
 * @property array|null $extras
 * @property int|null $option_group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Campaign $campaign
 * @property-read \Illuminate\Database\Eloquent\Collection|Question[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\OptionGroup|null $optiongroup
 * @property-read Question|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereConditions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereDepth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereExtras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereOptionGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question withoutChildren()
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Response
 *
 * @property int $id
 * @property int $invite_id
 * @property int $question_id
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invite $invite
 * @property-read \App\Models\Question $question
 * @method static \Illuminate\Database\Eloquent\Builder|Response newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Response newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Response query()
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereInviteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Response whereUpdatedAt($value)
 */
	class Response extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

