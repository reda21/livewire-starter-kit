<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'platform',
        'username',
        'url',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
