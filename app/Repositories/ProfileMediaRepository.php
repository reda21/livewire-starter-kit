<?php

namespace App\Repositories;

use App\Models\ProfileMedia;
use Illuminate\Database\Eloquent\Collection;

class ProfileMediaRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new ProfileMedia());
    }

    public function getMediaWithProfile(): Collection
    {
        return $this->model->with('profile')->get();
    }
}