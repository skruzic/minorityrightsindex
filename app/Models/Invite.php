<?php

namespace App\Models;

use App\Mail\InviteCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;

class Invite extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'email', 'token'];

    protected $casts = [
        'visited_pages' => 'array',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    public static function booted(): void
    {
        static::created(function (Invite $invite) {
            Mail::to($invite->email)->send(new InviteCreated($invite));
        });
    }
}
