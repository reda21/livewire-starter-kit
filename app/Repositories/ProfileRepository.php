<?php

namespace App\Repositories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;

class ProfileRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Profile());
    }

    public function getProfilesWithUser(): Collection
    {
        return $this->model->with('user')->get();
    }

    public function getProfilesWithMedia(): Collection
    {
        return $this->model->with('media')->get();
    }
}