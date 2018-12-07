<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    protected $fillable = ['name', 'description', 'options'];

    protected $casts = [
        'options' => 'array',
    ];
}
