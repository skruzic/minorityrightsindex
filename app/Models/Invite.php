<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = ['campaign_id', 'email', 'token'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
