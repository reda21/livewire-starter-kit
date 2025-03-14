<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileMedia extends Model
{
    protected $table = 'profiles_media';

    use HasFactory;

    protected $fillable = ['profile_id', 'path', 'type'];

    protected $casts = [
        'type' => \App\Enums\MediaType::class,
    ];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
