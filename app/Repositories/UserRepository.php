<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function getUsersWithRoles(): Collection
    {
        return $this->model->with('roles')->get();
    }

    public function getUsersWithPermissions(): Collection
    {
        return $this->model->with('permissions')->get();
    }
}