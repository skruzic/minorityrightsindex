<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'description', 'options'];

    protected $casts = ['options' => 'array'];
}
