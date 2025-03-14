<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $record = $this->find($id);
        if ($record) {
            $record->update($attributes);
            return $record;
        }
        return null;
    }

    public function delete($id)
    {
        $record = $this->find($id);
        if ($record) {
            $record->delete();
            return true;
        }
        return false;
    }

    public function search($query)
    {
        return $this->model->where('name', 'like', '%' . $query . '%')->get();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function withRelations($relations)
    {
        return $this->model->with($relations);
    }
}