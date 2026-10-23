<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OptionGroup extends Model
{
    protected $fillable = ['name', 'description', 'options'];

    protected $casts = [
        'options' => 'array',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
