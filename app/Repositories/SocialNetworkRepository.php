<?php

namespace App\Repositories;

use App\Models\SocialNetwork;
use Illuminate\Database\Eloquent\Collection;

class SocialNetworkRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new SocialNetwork());
    }

    public function getSocialNetworksWithUser(): Collection
    {
        return $this->model->with('user')->get();
    }
}