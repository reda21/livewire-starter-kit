<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'genre',
        'location',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function socialNetworks(): HasMany
    {
        return $this->hasMany(SocialNetwork::class);
    }

    public function avatarMedia()
    {
        return $this->hasOne(ProfileMedia::class)->where('type', 'avatar');
    }

    public function avatar()
    {
        return $this->avatarMedia();
    }

    public function coverMedia()
    {
        return $this->hasOne(ProfileMedia::class)->where('type', 'cover');
    }

    public function cover()
    {
        return $this->coverMedia();
    }
}
