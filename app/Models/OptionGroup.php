<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'description', 'options'];
}
