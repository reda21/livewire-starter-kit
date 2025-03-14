<?php

namespace App\Contracts;

interface RoleContract
{
    /**
     * Get the users associated with the role.
     */
    public function users();

    /**
     * Get the permissions associated with the role.
     */
    public function permissions();
}