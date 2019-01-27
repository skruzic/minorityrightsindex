<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class OptionGroup extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'description', 'options'];

    protected $casts = ['options' => 'array'];
}
