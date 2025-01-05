<?php

namespace App\Repositories\Eloquent;

abstract class BaseRepository
{
    protected $model;

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->getById($id);
        return $record ? $record->update($data) : null;
    }

    public function delete($id)
    {
        $record = $this->getById($id);
        return $record ? $record->delete() : null;
    }
}
