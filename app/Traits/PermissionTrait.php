<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;

trait PermissionTrait
{
    /**
     * Get the roles associated with the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get the users associated with the permission.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}