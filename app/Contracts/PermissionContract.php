<?php

namespace App\Contracts;

interface PermissionContract
{
    /**
     * Get the roles associated with the permission.
     */
    public function roles();

    /**
     * Get the users associated with the permission.
     */
    public function users();
}