<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Permission;

trait RoleTrait
{
    /**
     * Get the users associated with the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the permissions associated with the role.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}