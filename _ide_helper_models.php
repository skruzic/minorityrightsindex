<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Campaign
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 */
	class Campaign extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question
 *
 * @property int $id
 * @property string $type
 * @property string $question
 * @property int|null $option_group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OptionGroup|null $options
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereOptionGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SectionQuestion
 *
 * @property int $id
 * @property int $section_id
 * @property int $question_id
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionQuestion whereUpdatedAt($value)
 */
	class SectionQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Section
 *
 * @property int $id
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Section whereUpdatedAt($value)
 */
	class Section extends \Eloquent {}
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OptionGroup whereUpdatedAt($value)
 */
	class OptionGroup extends \Eloquent {}
}

